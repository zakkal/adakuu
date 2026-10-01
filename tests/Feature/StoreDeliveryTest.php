<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Package;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreDeliveryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Setting::set('admin_whatsapp_number', '081234567890');

        $cat = Category::create([
            'name' => 'AI',
            'slug' => 'ai',
        ]);

        $product = Product::create([
            'category_id' => $cat->id,
            'name' => 'ChatGPT Plus',
            'slug' => 'chatgpt-plus',
            'is_active' => true,
        ]);

        $this->package = Package::create([
            'product_id' => $product->id,
            'name' => '1 Bulan',
            'price' => 49000,
            'is_available' => true,
        ]);
    }

    public function test_customer_can_place_order_and_flow_to_paid_status()
    {
        // 1. Submit checkout
        $response = $this->post(route('checkout.store'), [
            'package_id' => $this->package->id,
            'customer_name' => 'Muhammad Zaki',
            'customer_whatsapp' => '081234567890',
        ]);

        $order = Order::first();
        $this->assertNotNull($order);
        $response->assertRedirect(route('orders.checkout', $order->order_number));
        $this->assertEquals('UNPAID', $order->payment_status);

        // 2. Payment verification (Webhook / Payment simulate)
        $payResponse = $this->post(route('orders.pay.simulate', $order->order_number));
        $payResponse->assertRedirect(route('orders.success', $order->order_number));

        $order->refresh();
        $this->assertEquals('PAID', $order->payment_status);
        $this->assertEquals('PAID', $order->order_status);

        // 3. Success page DOES NOT display any automatic account credentials
        $successPage = $this->get(route('orders.success', $order->order_number));
        $successPage->assertSee('Pembayaran Berhasil');
        $successPage->assertSee('Admin akan segera menghubungi kamu melalui WhatsApp');
        $successPage->assertDontSee('Password');
        $successPage->assertDontSee('Username');
        $successPage->assertDontSee('Reveal Account');

        // 4. WhatsApp template URL formatting
        $waLink = $order->whatsapp_link;
        $this->assertStringContainsString('https://wa.me/6281234567890', $waLink);
        $this->assertStringContainsString(urlencode('#'.$order->order_number), $waLink);
    }

    public function test_admin_order_status_transitions()
    {
        $order = Order::create([
            'order_number' => 'YP-20260928-TEST',
            'package_id' => $this->package->id,
            'customer_name' => 'Zaki',
            'customer_whatsapp' => '081234567890',
            'total_amount' => 49000,
            'payment_status' => 'PAID',
            'order_status' => 'PAID',
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Admin changes status to PROCESSING
        $this->actingAs($admin)->post(route('admin.orders.process', $order->id), [
            'admin_note' => 'Pesanan sedang kami proses.',
        ]);

        $order->refresh();
        $this->assertEquals('PROCESSING', $order->order_status);
        $this->assertEquals('Pesanan sedang kami proses.', $order->admin_note);

        // Admin completes order
        $this->post(route('admin.orders.complete', $order->id), [
            'admin_note' => 'Pesanan sudah selesai. Terima kasih telah berbelanja di YUK PRO IN.',
        ]);

        $order->refresh();
        $this->assertEquals('COMPLETED', $order->order_status);
        $this->assertEquals('Pesanan sudah selesai. Terima kasih telah berbelanja di YUK PRO IN.', $order->admin_note);
    }
}

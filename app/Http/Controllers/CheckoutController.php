<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Mail\OrderPaid;
use App\Models\AdminNotification;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    private function initMidtrans(): void
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = config('services.midtrans.is_sanitized', true);
        Config::$is3ds = config('services.midtrans.is_3ds', true);
    }

    public function store(Request $request)
    {
        // User yang sampai sini PASTI sudah login (karena button hanya muncul jika @auth)
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'quantity' => 'required|integer|min:1|max:10',
            'customer_name' => 'required|string|max:255',
            'customer_whatsapp' => 'required|string|max:30',
        ]);

        $package = Package::findOrFail($request->package_id);
        $quantity = $request->quantity;

        if (! $package->is_available) {
            return back()->with('error', 'Maaf, paket ini sedang Sold Out.');
        }

        // Check stock availability for requested quantity
        if (! $package->hasStock() || $package->stock < $quantity) {
            $package->update(['is_available' => false]);

            return back()->with('error', 'Maaf, stock tidak mencukupi. Stock tersedia: '.$package->stock);
        }

        $totalAmount = $package->price * $quantity;
        $orderNumber = 'YP-'.date('Ymd').'-'.strtoupper(Str::random(5));

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => $orderNumber,
            'package_id' => $package->id,
            'quantity' => $quantity,
            'customer_name' => $request->customer_name,
            'customer_whatsapp' => $request->customer_whatsapp,
            'total_amount' => $totalAmount,
            'payment_method' => 'Midtrans Snap / QRIS',
            'payment_status' => 'UNPAID',
            'order_status' => 'PENDING',
        ]);

        // Decrement stock by quantity
        $package->decrementStock($quantity);

        // Create admin notification for new checkout
        AdminNotification::createCheckoutNotification($order);

        // Send order confirmation email
        if (auth()->user()->email) {
            try {
                Mail::to(auth()->user()->email)->send(new OrderConfirmation($order));
            } catch (\Exception $e) {
                logger()->error('Failed to send order confirmation email: '.$e->getMessage());
            }
        }

        return redirect()->route('orders.checkout', $order->order_number);
    }

    public function showCheckout(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('package.product')->firstOrFail();

        // If order already paid, redirect to success page
        if ($order->payment_status === 'PAID') {
            return redirect()->route('orders.success', $order->order_number);
        }

        $snapToken = null;

        // Only generate Snap token if keys are configured
        if (config('services.midtrans.client_key') && config('services.midtrans.server_key')) {
            try {
                $this->initMidtrans();

                $params = [
                    'transaction_details' => [
                        'order_id' => $order->order_number,
                        'gross_amount' => (int) $order->total_amount,
                    ],
                    'customer_details' => [
                        'first_name' => $order->customer_name,
                        'phone' => $order->customer_whatsapp,
                    ],
                    'item_details' => [
                        [
                            'id' => (string) $order->package_id,
                            'price' => (int) $order->total_amount,
                            'quantity' => 1,
                            'name' => substr($order->package->product->name.' - '.$order->package->name, 0, 50),
                        ],
                    ],
                    'enabled_payments' => ['gopay', 'qris', 'shopeepay', 'other_qris', 'bca_va', 'bni_va', 'bri_va', 'permata_va'],
                ];

                $snapToken = Snap::getSnapToken($params);
            } catch (\Exception $e) {
                logger()->error('Midtrans Snap Error: '.$e->getMessage(), [
                    'order_number' => $order->order_number,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return view('orders.checkout', compact('order', 'snapToken'));
    }

    public function simulatePayment(Request $request, string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        if ($order->payment_status === 'PAID') {
            return redirect()->route('orders.success', $order->order_number);
        }

        $order->update([
            'payment_status' => 'PAID',
            'order_status' => 'PAID',
            'paid_at' => now(),
            'admin_note' => 'Pesanan kamu sudah kami terima. Admin akan segera menghubungi kamu melalui WhatsApp untuk proses pesanan.',
        ]);

        // Create admin notification for payment success
        AdminNotification::createPaymentSuccessNotification($order);

        // Send order paid email
        if ($order->user && $order->user->email) {
            try {
                Mail::to($order->user->email)->send(new OrderPaid($order));
            } catch (\Exception $e) {
                logger()->error('Failed to send order paid email: '.$e->getMessage());
            }
        }

        return redirect()->route('orders.success', $order->order_number);
    }

    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('package.product')->firstOrFail();

        return view('orders.success', compact('order'));
    }
}

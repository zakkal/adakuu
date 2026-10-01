<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Order;
use App\Mail\OrderPaid;
use Illuminate\Support\Facades\Mail;

echo "====================================\n";
echo "TEST EMAIL FLOW - ORDER PAID\n";
echo "====================================\n\n";

// Get latest order
$order = Order::with('user', 'package.product')->latest()->first();

if (!$order) {
    echo "❌ Tidak ada order untuk di-test.\n";
    exit(1);
}

echo "Order ditemukan:\n";
echo "- Order Number: {$order->order_number}\n";
echo "- Customer: {$order->customer_name}\n";
echo "- Email: {$order->user->email}\n";
echo "- Status: {$order->payment_status}\n";
echo "- Product: {$order->package->product->name}\n\n";

echo "Mengirim email Order Paid...\n\n";

try {
    Mail::to($order->user->email)->send(new OrderPaid($order));
    
    echo "====================================\n";
    echo "✅ EMAIL BERHASIL DIKIRIM!\n";
    echo "====================================\n\n";
    echo "Email 'Pembayaran Berhasil' sudah dikirim ke:\n";
    echo "→ {$order->user->email}\n\n";
    echo "Silakan cek:\n";
    echo "1. Inbox Gmail\n";
    echo "2. Folder SPAM jika tidak ada di inbox\n\n";
    echo "Subject: Pembayaran Berhasil - Order #{$order->order_number}\n\n";
    
} catch (Exception $e) {
    echo "====================================\n";
    echo "❌ GAGAL KIRIM EMAIL\n";
    echo "====================================\n\n";
    echo "Error: " . $e->getMessage() . "\n\n";
}

<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Order;

echo "=== LATEST ORDERS ===\n\n";

$orders = Order::with('user')->latest()->take(5)->get();

if ($orders->isEmpty()) {
    echo "Belum ada order.\n";
} else {
    foreach ($orders as $order) {
        echo "Order: {$order->order_number}\n";
        echo "User: {$order->user->name}\n";
        echo "Email: {$order->user->email}\n";
        echo "Status: {$order->payment_status}\n";
        echo "Created: {$order->created_at}\n";
        echo "---\n";
    }
}

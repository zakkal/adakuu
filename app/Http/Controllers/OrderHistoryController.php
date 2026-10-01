<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('package.product')
            ->latest()
            ->paginate(10);

        return view('orders.history', compact('orders'));
    }

    public function show(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->with('package.product')
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}

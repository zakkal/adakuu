<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = collect();
        if ($request->filled('search')) {
            $search = trim($request->search);
            // Search by order_number or whatsapp
            $orders = Order::where('order_number', 'like', "%{$search}%")
                ->orWhere('customer_whatsapp', 'like', "%{$search}%")
                ->with('package.product')
                ->latest()
                ->get();
        }

        return view('orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('package.product')->firstOrFail();

        return view('orders.show', compact('order'));
    }
}

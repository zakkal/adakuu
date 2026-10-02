<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Order;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function request(Request $request, string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        if (! $order->canRequestRefund()) {
            return back()->with('error', 'Maaf, pesanan ini tidak memenuhi syarat refund. Refund hanya berlaku 24 jam setelah pembayaran.');
        }

        $request->validate([
            'refund_reason' => 'required|string|max:500',
            'refund_bank_name' => 'required|string|max:100',
            'refund_account_name' => 'required|string|max:255',
            'refund_account_number' => 'required|string|max:50',
        ]);

        $order->update([
            'refund_status' => 'REQUESTED',
            'refund_reason' => $request->refund_reason,
            'refund_bank_name' => $request->refund_bank_name,
            'refund_account_name' => $request->refund_account_name,
            'refund_account_number' => $request->refund_account_number,
            'refund_requested_at' => now(),
            'refund_amount' => $order->total_amount, // 100% refund
        ]);

        // Create admin notification for refund request
        AdminNotification::createRefundRequestNotification($order);

        return redirect()->route('orders.show', $order->order_number)
            ->with('success', 'Permintaan refund berhasil diajukan. Admin akan memproses dalam 1x24 jam.');
    }
}

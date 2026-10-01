<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderCompleted;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $query = Order::with('package.product')->latest();

        if ($status) {
            $query->where('order_status', $status);
        }

        $orders = $query->paginate(20);
        $newPaidCount = Order::where('order_status', 'PAID')->count();
        $refundRequestCount = Order::where('refund_status', 'REQUESTED')->count();

        return view('admin.orders.index', compact('orders', 'newPaidCount', 'refundRequestCount', 'status'));
    }

    public function paid()
    {
        $orders = Order::with('package.product')
            ->where('order_status', 'PAID')
            ->latest()
            ->paginate(20);

        return view('admin.orders.paid', compact('orders'));
    }

    public function refunds()
    {
        $orders = Order::with('package.product')
            ->where('refund_status', 'REQUESTED')
            ->latest()
            ->paginate(20);

        return view('admin.orders.refunds', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('package.product')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function process(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $note = $request->input('admin_note', 'Pesanan sedang kami proses. Silakan tunggu admin menghubungi melalui WhatsApp.');

        $order->update([
            'order_status' => 'PROCESSING',
            'admin_note' => $note,
            'processed_at' => now(),
        ]);

        return back()->with('success', 'Status pesanan berhasil diubah menjadi PROCESSING.');
    }

    public function complete(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $note = $request->input('admin_note', 'Pesanan sudah selesai. Terima kasih telah berbelanja di YUK PRO IN.');

        $order->update([
            'order_status' => 'COMPLETED',
            'admin_note' => $note,
            'completed_at' => now(),
        ]);

        // Send order completed email
        if ($order->user && $order->user->email) {
            try {
                Mail::to($order->user->email)->send(new OrderCompleted($order));
            } catch (\Exception $e) {
                logger()->error('Failed to send order completed email: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Status pesanan berhasil diubah menjadi COMPLETED.');
    }

    public function approveRefund($id)
    {
        $order = Order::findOrFail($id);

        if ($order->refund_status !== 'REQUESTED') {
            return back()->with('error', 'Refund tidak dalam status REQUESTED.');
        }

        $order->update([
            'refund_status' => 'APPROVED',
            'refund_processed_at' => now(),
            'admin_note' => 'Refund sebesar Rp'.number_format($order->refund_amount, 0, ',', '.').' telah diproses dan ditransfer ke rekening Anda.',
        ]);

        return back()->with('success', 'Refund berhasil disetujui. Dana akan dikembalikan ke customer.');
    }

    public function rejectRefund(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->refund_status !== 'REQUESTED') {
            return back()->with('error', 'Refund tidak dalam status REQUESTED.');
        }

        $order->update([
            'refund_status' => 'REJECTED',
            'refund_processed_at' => now(),
            'admin_note' => $request->input('reject_reason', 'Permintaan refund Anda ditolak.'),
        ]);

        return back()->with('success', 'Refund ditolak.');
    }
}

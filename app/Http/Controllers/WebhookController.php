<?php

namespace App\Http\Controllers;

use App\Mail\OrderPaid;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Notification;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);

        try {
            $notif = new Notification;

            $orderNumber = $notif->order_id;
            $transactionStatus = $notif->transaction_status;
            $type = $notif->payment_type;
            $fraud = $notif->fraud_status ?? 'accept';

            $order = Order::where('order_number', $orderNumber)->first();

            if (! $order) {
                logger()->warning('Webhook received for non-existent order', ['order_number' => $orderNumber]);

                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }

            // Prevent duplicate processing
            if ($order->payment_status === 'PAID') {
                return response()->json(['status' => 'success', 'message' => 'Order already paid', 'order_status' => $order->order_status]);
            }

            if ($transactionStatus === 'capture') {
                if ($type === 'credit_card') {
                    if ($fraud === 'challenge') {
                        $order->update(['payment_status' => 'UNPAID']);
                    } else {
                        $order->update([
                            'payment_status' => 'PAID',
                            'order_status' => 'PAID',
                            'paid_at' => now(),
                            'admin_note' => 'Pesanan kamu sudah kami terima. Admin akan segera menghubungi kamu melalui WhatsApp untuk proses pesanan.',
                        ]);
                    }
                }
            } elseif ($transactionStatus === 'settlement') {
                $order->update([
                    'payment_status' => 'PAID',
                    'order_status' => 'PAID',
                    'paid_at' => now(),
                    'admin_note' => 'Pesanan kamu sudah kami terima. Admin akan segera menghubungi kamu melalui WhatsApp untuk proses pesanan.',
                ]);
                
                // Send payment success email
                if ($order->user && $order->user->email) {
                    try {
                        Mail::to($order->user->email)->send(new OrderPaid($order));
                    } catch (\Exception $e) {
                        logger()->error('Failed to send payment confirmation email: ' . $e->getMessage());
                    }
                }
            } elseif ($transactionStatus === 'pending') {
                $order->update(['payment_status' => 'UNPAID']);
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $order->update([
                    'payment_status' => 'EXPIRED',
                    'order_status' => 'CANCELLED',
                ]);
            }

            logger()->info('Midtrans webhook processed', [
                'order_number' => $orderNumber,
                'transaction_status' => $transactionStatus,
                'payment_type' => $type,
            ]);

            return response()->json(['status' => 'success', 'order_status' => $order->order_status]);

        } catch (\Exception $e) {
            logger()->error('Midtrans webhook error', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            // Fallback for manual HTTP payload
            $orderNumber = $request->input('order_id') ?? $request->input('order_number');
            $status = $request->input('transaction_status') ?? $request->input('status');

            if ($orderNumber) {
                $order = Order::where('order_number', $orderNumber)->first();
                if ($order && in_array(strtolower($status), ['settlement', 'capture', 'paid', 'success'])) {
                    if ($order->payment_status !== 'PAID') {
                        $order->update([
                            'payment_status' => 'PAID',
                            'order_status' => 'PAID',
                            'paid_at' => now(),
                            'admin_note' => 'Pesanan kamu sudah kami terima. Admin akan segera menghubungi kamu melalui WhatsApp untuk proses pesanan.',
                        ]);
                    }

                    return response()->json(['status' => 'success', 'order_status' => $order->order_status]);
                }
            }

            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}

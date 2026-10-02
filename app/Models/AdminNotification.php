<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'title', 'message', 'data', 'is_read'])]
class AdminNotification extends Model
{
    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
    ];

    /**
     * Create a new checkout notification
     */
    public static function createCheckoutNotification($order)
    {
        return self::create([
            'type' => 'checkout',
            'title' => 'Pesanan Baru',
            'message' => "{$order->customer_name} melakukan checkout",
            'data' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->customer_name,
                'customer_whatsapp' => $order->customer_whatsapp,
                'product_name' => $order->package->product->name,
                'package_name' => $order->package->name,
                'quantity' => $order->quantity,
                'total_amount' => $order->total_amount,
            ],
        ]);
    }

    /**
     * Create a refund request notification
     */
    public static function createRefundRequestNotification($order)
    {
        return self::create([
            'type' => 'refund_request',
            'title' => 'Permintaan Refund',
            'message' => "{$order->customer_name} mengajukan refund untuk pesanan #{$order->order_number}",
            'data' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->customer_name,
                'customer_whatsapp' => $order->customer_whatsapp,
                'product_name' => $order->package->product->name,
                'package_name' => $order->package->name,
                'total_amount' => $order->total_amount,
                'refund_reason' => $order->refund_reason,
            ],
        ]);
    }

    /**
     * Create a payment success notification
     */
    public static function createPaymentSuccessNotification($order)
    {
        return self::create([
            'type' => 'payment_success',
            'title' => 'Pembayaran Berhasil',
            'message' => "{$order->customer_name} telah menyelesaikan pembayaran Rp".number_format($order->total_amount, 0, ',', '.'),
            'data' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->customer_name,
                'product_name' => $order->package->product->name,
                'package_name' => $order->package->name,
                'total_amount' => $order->total_amount,
            ],
        ]);
    }

    /**
     * Get icon based on notification type
     */
    public function getIconAttribute()
    {
        return match ($this->type) {
            'checkout' => '🛒',
            'refund_request' => '💸',
            'payment_success' => '✅',
            'refund_approved' => '✔️',
            'refund_rejected' => '❌',
            'warranty_claim' => '🛡️',
            default => '📢',
        };
    }

    /**
     * Get color based on notification type
     */
    public function getColorAttribute()
    {
        return match ($this->type) {
            'checkout' => 'blue',
            'refund_request' => 'amber',
            'payment_success' => 'emerald',
            'refund_approved' => 'green',
            'refund_rejected' => 'red',
            'warranty_claim' => 'purple',
            default => 'gray',
        };
    }
}

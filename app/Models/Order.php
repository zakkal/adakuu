<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'package_id',
        'quantity',
        'customer_name',
        'customer_whatsapp',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'admin_note',
        'paid_at',
        'processed_at',
        'completed_at',
        'refund_status',
        'refund_reason',
        'refund_bank_name',
        'refund_account_name',
        'refund_account_number',
        'refund_requested_at',
        'refund_processed_at',
        'refund_amount',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
        'refund_requested_at' => 'datetime',
        'refund_processed_at' => 'datetime',
    ];

    public function canRequestRefund(): bool
    {
        // Hanya bisa refund jika:
        // 1. Status PAID atau PROCESSING
        // 2. Belum pernah request refund (NOT_REQUESTED)
        // 3. Dalam 24 jam setelah pembayaran
        if (! in_array($this->payment_status, ['PAID'])) {
            return false;
        }

        if ($this->refund_status !== 'NOT_REQUESTED') {
            return false;
        }

        if (! $this->paid_at) {
            return false;
        }

        return $this->paid_at->diffInHours(now()) < 24;
    }

    public function getRefundEligibleHoursAttribute(): int
    {
        if (! $this->paid_at) {
            return 0;
        }

        $hoursPassed = $this->paid_at->diffInHours(now());

        return max(0, 24 - $hoursPassed);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getWhatsappLinkAttribute()
    {
        $adminNumber = Setting::get('admin_whatsapp_number', '081234567890');
        // Format to international standard (62...)
        $formattedNumber = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $adminNumber));

        $productName = $this->package->product->name ?? 'Produk';
        $packageName = $this->package->name ?? 'Paket';
        $formattedPrice = 'Rp'.number_format($this->total_amount, 0, ',', '.');

        $message = "Halo Admin YUK PRO IN, saya sudah melakukan pembayaran untuk pesanan:\n\n"
            ."Order ID: #{$this->order_number}\n\n"
            ."Produk: {$productName}\n"
            ."Paket: {$packageName}\n\n"
            ."Total: {$formattedPrice}\n\n"
            .'Mohon diproses. Terima kasih.';

        return "https://wa.me/{$formattedNumber}?text=".urlencode($message);
    }
}

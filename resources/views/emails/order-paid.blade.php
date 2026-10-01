<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f7f9fc; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 30px; text-align: center; }
        .header h1 { color: white; margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .order-id { background: #f0fdf4; border-left: 4px solid #10b981; padding: 15px; margin: 20px 0; border-radius: 8px; }
        .order-id strong { color: #10b981; font-size: 18px; }
        .product-info { background: #f9fafb; padding: 20px; border-radius: 12px; margin: 20px 0; }
        .product-info h3 { margin-top: 0; color: #1f2937; }
        .price { font-size: 24px; font-weight: bold; color: #10b981; margin: 15px 0; }
        .button { display: inline-block; background: #10b981; color: white; padding: 14px 28px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; }
        .button:hover { background: #059669; }
        .footer { background: #f9fafb; padding: 20px; text-align: center; color: #6b7280; font-size: 14px; }
        .status-badge { display: inline-block; background: #dcfce7; color: #166534; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .checkmark { font-size: 48px; color: #10b981; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="checkmark">✓</div>
            <h1>Pembayaran Berhasil!</h1>
        </div>
        
        <div class="content">
            <p>Halo, <strong>{{ $order->customer_name }}</strong>!</p>
            
            <p>Terima kasih! Pembayaran Anda telah berhasil diverifikasi. Pesanan Anda sedang diproses oleh tim kami.</p>
            
            <div class="order-id">
                <strong>Order ID:</strong> #{{ $order->order_number }}
            </div>
            
            <div class="product-info">
                <h3>📦 Detail Pesanan</h3>
                <p><strong>Produk:</strong> {{ $order->package->product->name }}</p>
                <p><strong>Paket:</strong> {{ $order->package->name }}</p>
                <p><strong>Durasi:</strong> {{ $order->package->duration }} hari</p>
                
                <div class="price">
                    Total Dibayar: Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                </div>
                
                <p><span class="status-badge">✓ Pembayaran Berhasil</span></p>
            </div>
            
            <p><strong>Langkah selanjutnya:</strong></p>
            <ol>
                <li>Tim kami sedang memproses pesanan Anda</li>
                <li>Akun akan dikirim ke WhatsApp dalam waktu singkat</li>
                <li>Anda akan mendapat notifikasi saat pesanan selesai</li>
            </ol>
            
            <div style="text-align: center;">
                <a href="{{ route('orders.show', $order->order_number) }}" class="button">
                    📋 Lihat Detail Pesanan
                </a>
            </div>
            
            <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">
                <strong>Butuh Bantuan?</strong><br>
                Hubungi kami via WhatsApp: {{ $order->customer_phone }}
            </p>
        </div>
        
        <div class="footer">
            <p><strong>Adakuu</strong> - Solusi Akun Premium Terpercaya</p>
            <p>© 2026 Adakuu. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

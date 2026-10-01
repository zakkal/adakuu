<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Selesai</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f7f9fc; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); padding: 30px; text-align: center; }
        .header h1 { color: white; margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .order-id { background: #eff6ff; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; border-radius: 8px; }
        .order-id strong { color: #3b82f6; font-size: 18px; }
        .product-info { background: #f9fafb; padding: 20px; border-radius: 12px; margin: 20px 0; }
        .product-info h3 { margin-top: 0; color: #1f2937; }
        .admin-note { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; border-radius: 8px; }
        .button { display: inline-block; background: #3b82f6; color: white; padding: 14px 28px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; }
        .button:hover { background: #2563eb; }
        .footer { background: #f9fafb; padding: 20px; text-align: center; color: #6b7280; font-size: 14px; }
        .status-badge { display: inline-block; background: #dbeafe; color: #1e40af; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .success-icon { font-size: 48px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">🎉</div>
            <h1>Pesanan Selesai!</h1>
        </div>
        
        <div class="content">
            <p>Halo, <strong>{{ $order->customer_name }}</strong>!</p>
            
            <p>Kabar gembira! Pesanan Anda telah selesai diproses dan akun sudah dikirim ke WhatsApp Anda.</p>
            
            <div class="order-id">
                <strong>Order ID:</strong> #{{ $order->order_number }}
            </div>
            
            <div class="product-info">
                <h3>📦 Detail Pesanan</h3>
                <p><strong>Produk:</strong> {{ $order->package->product->name }}</p>
                <p><strong>Paket:</strong> {{ $order->package->name }}</p>
                <p><strong>Durasi:</strong> {{ $order->package->duration }} hari</p>
                <p><strong>Nomor WhatsApp:</strong> {{ $order->customer_phone }}</p>
                
                <p><span class="status-badge">✓ Pesanan Selesai</span></p>
            </div>
            
            @if($order->admin_note)
            <div class="admin-note">
                <p><strong>📝 Pesan dari Admin:</strong></p>
                <p style="margin: 10px 0 0 0; white-space: pre-line;">{{ $order->admin_note }}</p>
            </div>
            @endif
            
            <p><strong>Yang perlu Anda lakukan:</strong></p>
            <ol>
                <li>Cek WhatsApp Anda di nomor {{ $order->customer_phone }}</li>
                <li>Simpan detail akun yang dikirimkan admin</li>
                <li>Gunakan akun sesuai durasi paket yang dibeli</li>
                <li>Hubungi kami jika ada kendala</li>
            </ol>
            
            <div style="text-align: center;">
                <a href="{{ $order->whatsapp_link }}" class="button">
                    💬 Buka WhatsApp
                </a>
            </div>
            
            <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px;">
                <strong>Terima kasih telah berbelanja di Adakuu!</strong><br>
                Kami harap Anda puas dengan layanan kami. Jangan ragu untuk berbelanja lagi! 🎁
            </p>
        </div>
        
        <div class="footer">
            <p><strong>Adakuu</strong> - Solusi Akun Premium Terpercaya</p>
            <p>© 2026 Adakuu. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

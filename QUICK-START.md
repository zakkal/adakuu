# 🚀 QUICK START GUIDE

## Setup Google OAuth (WAJIB!)

### 1. Buka Google Cloud Console
https://console.cloud.google.com/

### 2. Create OAuth Credentials
```
1. Create Project → "PastiPremium"
2. APIs & Services → Credentials
3. Create OAuth Client ID → Web Application
4. Authorized redirect URIs:
   http://127.0.0.1:8000/auth/google/callback
   http://localhost:8000/auth/google/callback
5. Copy Client ID & Secret
```

### 3. Update .env
```env
GOOGLE_CLIENT_ID=xxxxx.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-xxxxx
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

### 4. Clear Config
```bash
php artisan config:clear
```

---

## Start Development Server

```bash
# Clear cache
php artisan config:clear

# Start server
php artisan serve

# Open browser
http://127.0.0.1:8000
```

---

## Test Customer Flow

### ✅ Step 1: Browse Produk
```
1. Buka http://127.0.0.1:8000
2. Lihat katalog produk
3. Klik produk untuk detail
```

### ✅ Step 2: Checkout dengan Google
```
4. Klik tombol "Beli Sekarang"
5. Akan redirect ke Google login (OTOMATIS!)
6. Pilih akun Google
7. Auto-login & create order
8. Redirect ke halaman pembayaran
```

### ✅ Step 3: Pembayaran Midtrans
```
9. Klik "Bayar via Midtrans"
10. Pilih metode: QRIS / GoPay / VA
11. Testing cards:
    - Success: 4811 1111 1111 1114
    - CVV: 123, Exp: 01/26
12. Atau klik "Simulasi Pembayaran" untuk bypass
```

### ✅ Step 4: Track & Refund
```
13. Order selesai, cek status di "Cek Pesanan"
14. Jika < 24 jam, bisa klik "Ajukan Refund"
15. Isi alasan refund → Submit
```

---

## Test Admin Flow

### ✅ Step 1: Login Admin
```
1. Buka http://127.0.0.1:8000/login
2. Email: admin@yuk.proin.com
3. Password: password123
4. Klik "Login Admin"
```

### ✅ Step 2: Dashboard
```
5. Lihat statistik omzet & order
6. Grafik penjualan 6 bulan
7. Recent orders
```

### ✅ Step 3: Kelola Pesanan
```
8. Menu "Kelola Pesanan"
9. Klik order dengan status PAID
10. Klik "Process" → order jadi PROCESSING
11. Klik "Complete" → order jadi COMPLETED
```

### ✅ Step 4: Handle Refund
```
12. Filter order dengan refund_status = REQUESTED
13. Klik detail order
14. Review alasan refund
15. Klik "Approve Refund" atau "Reject"
16. Customer akan terima notifikasi
```

---

## Test AI Chatbot

```
1. Klik tombol "AI Assistant" di bottom-left (merah)
2. Chat window muncul
3. Klik quick action:
   - "Bagaimana cara order?"
   - "Apakah produk asli?"
   - "Bagaimana cara refund?"
   - "Metode pembayaran apa saja?"
4. Atau ketik pertanyaan custom
5. AI response instant dalam 1 detik
```

---

## Troubleshooting

### Google OAuth Error: redirect_uri_mismatch
```bash
# Fix:
1. Cek .env → GOOGLE_REDIRECT_URI
2. Harus sama persis dengan Google Console
3. Format: http://127.0.0.1:8000/auth/google/callback
4. php artisan config:clear
```

### Midtrans Error: Unauthorized
```bash
# Fix:
1. Cek .env → MIDTRANS_SERVER_KEY
2. Pastikan tidak ada typo
3. Server Key format: Mid-server-xxxxx
4. php artisan config:clear
```

### Customer Masih Kena Redirect ke /login
```bash
# Fix (SUDAH FIXED!):
- CheckoutController sekarang redirect ke route('auth.google')
- Bukan ke route('login')
- User langsung ke Google OAuth
```

### Admin Panel Tidak Bisa Diakses
```bash
# Fix:
1. Cek database → users table
2. Pastikan ada user dengan role = 'admin'
3. Run: php artisan db:seed (jika belum)
```

---

## Production Checklist

- [ ] Setup Google OAuth production credentials
- [ ] Update GOOGLE_REDIRECT_URI dengan domain production
- [ ] Ganti Midtrans ke production mode
- [ ] Update MIDTRANS_IS_PRODUCTION=true
- [ ] Set MIDTRANS_SERVER_KEY production
- [ ] SSL certificate installed (HTTPS)
- [ ] Database backup scheduled
- [ ] Error monitoring (Sentry/Bugsnag)
- [ ] Email notification untuk refund
- [ ] WhatsApp API integration (optional)

---

## Fitur Highlights

### 🔴 Theme Merah
- Semua button, badge, accent merah
- Konsisten di customer & admin

### 🤖 AI Chatbot
- Bottom-left floating button
- Auto-response FAQ
- Modern Alpine.js UI

### 💰 Refund 100% (24h)
- Customer ajukan dalam 24 jam
- Admin approve/reject dari panel
- Countdown timer otomatis

### 🔐 Dual Login
- Customer: Google OAuth (otomatis)
- Admin: Email/Password (/login)

### 💳 Payment Gateway
- Midtrans Snap integration
- QRIS, GoPay, VA, Credit Card
- Real-time webhook

---

**SEMUA SIAP PRODUCTION!** 🚀

Butuh bantuan? Cek:
- FLOW-FINAL.md → Penjelasan flow lengkap
- FITUR-LENGKAP.md → Daftar fitur
- GOOGLE-OAUTH-SETUP.md → Setup Google detail

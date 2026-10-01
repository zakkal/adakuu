# Setup Email Notifications dengan Gmail SMTP

## Status Saat Ini
✅ Sistem email sudah berfungsi (menggunakan `log` driver)
❌ Gmail SMTP belum berhasil (kredensial tidak valid)

## Cara Setup Gmail SMTP yang Benar

### Langkah 1: Pastikan 2-Factor Authentication Aktif
1. Buka https://myaccount.google.com/security
2. Di bagian "Signing in to Google", pastikan **2-Step Verification** sudah **ON**
3. Jika belum, aktifkan dulu 2-Step Verification

### Langkah 2: Generate App Password
1. Buka https://myaccount.google.com/apppasswords
2. Atau buka Google Account → Security → 2-Step Verification → App passwords
3. Pilih app: **Mail**
4. Pilih device: **Other (Custom name)** → ketik "Adakuu Website"
5. Klik **Generate**
6. Copy App Password yang muncul (16 karakter, tanpa spasi)
   - Contoh: `abcdéfghijklmnop`

### Langkah 3: Update File .env
Buka file `.env` dan ubah bagian MAIL menjadi:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=shoppinghere@shoppinghere.biz.id
MAIL_PASSWORD="PASTE_APP_PASSWORD_DISINI_TANPA_SPASI"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@adakuu.com"
MAIL_FROM_NAME="Adakuu"
```

⚠️ **PENTING**: 
- Gunakan email Gmail yang benar (`shoppinghere@shoppinghere.biz.id`)
- App Password harus 16 karakter TANPA SPASI
- Tetap pakai tanda kutip `"` di sekitar password

### Langkah 4: Clear Cache & Test
Jalankan di terminal:
```bash
php artisan config:clear
php test-email.php
```

Jika berhasil, kamu akan menerima email test di inbox.

### Langkah 5: Aktifkan SMTP (Setelah Test Berhasil)
Setelah `php test-email.php` berhasil tanpa error, berarti kredensial sudah benar.

## Mode Saat Ini: LOG Driver

Saat ini sistem menggunakan `MAIL_MAILER=log`, artinya:
- ✅ Email TIDAK akan dikirim ke inbox real
- ✅ Email akan disimpan di file: `storage/logs/laravel.log`
- ✅ Kamu bisa lihat isi email di log file
- ✅ Cocok untuk development & testing

Setelah Gmail SMTP berhasil setup, ubah `MAIL_MAILER=log` menjadi `MAIL_MAILER=smtp`.

## Troubleshooting

### Error: "Username and Password not accepted"
- App Password salah atau belum dibuat
- 2FA belum aktif di akun Gmail
- Email username salah

### Error: "Connection refused"
- Port atau host salah
- Firewall memblock port 587

### Email masuk Spam
- Tambahkan SPF record di DNS domain
- Setup DKIM
- Pastikan MAIL_FROM_ADDRESS sesuai domain

## Email yang Akan Dikirim

Sistem akan mengirim 3 jenis email:

1. **Order Confirmation** - Saat customer checkout (payment pending)
2. **Order Paid** - Saat payment berhasil via Midtrans
3. **Order Completed** - Saat admin tandai order selesai

Email hanya dikirim ke user yang punya email address.

---

📧 Untuk pertanyaan, hubungi developer atau cek dokumentasi Laravel Mail:
https://laravel.com/docs/11.x/mail

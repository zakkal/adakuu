# Alternatif Email Services

Jika Gmail SMTP tidak bisa dipakai, ada beberapa alternatif:

## 1. Mailtrap (RECOMMENDED untuk Development)

**Gratis & Mudah Setup!**

### Cara Setup Mailtrap:
1. Daftar di: https://mailtrap.io/
2. Pilih **Email Testing** (gratis)
3. Buat inbox baru
4. Copy credentials SMTP

Update `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@adakuu.com"
MAIL_FROM_NAME="Adakuu"
```

**Kelebihan:**
- ✅ Setup 2 menit
- ✅ Tidak perlu 2FA
- ✅ Preview email di web
- ✅ Test semua fitur email

**Kekurangan:**
- ❌ Email tidak masuk inbox real (hanya preview)
- ❌ Untuk development only

---

## 2. Gmail SMTP (RECOMMENDED untuk Production)

**Gratis, Reliable, Masuk Inbox Real**

Lihat panduan lengkap di: `SETUP-EMAIL-GMAIL.md`

Syarat:
- ✅ Punya akun Gmail
- ✅ 2-Factor Authentication aktif
- ✅ Generate App Password

---

## 3. Mailgun

**Free tier: 5,000 emails/month**

1. Daftar: https://www.mailgun.com/
2. Verify domain atau pakai sandbox
3. Copy API Key

Update `.env`:
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-api-key
MAIL_FROM_ADDRESS="noreply@adakuu.com"
MAIL_FROM_NAME="Adakuu"
```

Install package:
```bash
composer require symfony/mailgun-mailer symfony/http-client
```

---

## 4. SendGrid

**Free tier: 100 emails/day**

1. Daftar: https://sendgrid.com/
2. Create API Key
3. Setup

Update `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@adakuu.com"
MAIL_FROM_NAME="Adakuu"
```

---

## 5. Resend (MODERN & SIMPLE)

**Free tier: 3,000 emails/month**

1. Daftar: https://resend.com/
2. Get API Key
3. Setup

Install:
```bash
composer require resend/resend-php
```

Update `.env`:
```env
MAIL_MAILER=resend
RESEND_KEY=your_api_key
MAIL_FROM_ADDRESS="noreply@adakuu.com"
MAIL_FROM_NAME="Adakuu"
```

---

## Rekomendasi

### Untuk Development/Testing:
1. **MAIL_MAILER=log** (sudah aktif, paling mudah)
2. **Mailtrap** (kalau mau preview email di web)

### Untuk Production:
1. **Gmail SMTP** (gratis, reliable)
2. **Resend** (modern, simple API)
3. **Mailgun** (powerful, banyak fitur)

---

## Quick Setup Mailtrap (5 Menit)

Jika mau cepat test email masuk "inbox" (fake inbox):

1. Buka: https://mailtrap.io/register/signup
2. Login
3. Klik "Email Testing" → "Inboxes" → "My Inbox"
4. Tab "SMTP Settings" → "Integrations" → pilih "Laravel 9+"
5. Copy credentials ke `.env`
6. `php artisan config:clear`
7. `php test-email.php`
8. Lihat email masuk di Mailtrap web dashboard

DONE! ✅

---

Last Updated: 2026-10-01

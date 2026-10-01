<?php

echo "====================================\n";
echo "SETUP GMAIL SMTP - INTERACTIVE\n";
echo "====================================\n\n";

echo "Langkah 1: Pastikan 2FA aktif di Google Account\n";
echo "URL: https://myaccount.google.com/security\n\n";

echo "Langkah 2: Generate App Password\n";
echo "URL: https://myaccount.google.com/apppasswords\n\n";

echo "Setelah dapat App Password (16 karakter), paste di sini.\n";
echo "Format dari Google: xxxx xxxx xxxx xxxx (dengan spasi)\n";
echo "Contoh input: abcd efgh ijkl mnop\n\n";

echo "Masukkan App Password: ";
$appPassword = trim(fgets(STDIN));

// Remove all spaces
$appPasswordClean = str_replace(' ', '', $appPassword);

echo "\n";
echo "App Password (cleaned): {$appPasswordClean}\n";
echo "Panjang karakter: " . strlen($appPasswordClean) . " (harus 16)\n\n";

if (strlen($appPasswordClean) !== 16) {
    echo "❌ ERROR: App Password harus 16 karakter!\n";
    echo "Password kamu: " . strlen($appPasswordClean) . " karakter\n";
    exit(1);
}

echo "✓ Format App Password sudah benar!\n\n";

// Read .env file
$envFile = __DIR__ . '/.env';
$envContent = file_get_contents($envFile);

// Replace MAIL_MAILER
$envContent = preg_replace('/MAIL_MAILER=.*/m', 'MAIL_MAILER=smtp', $envContent);

// Replace MAIL_PASSWORD
$envContent = preg_replace('/MAIL_PASSWORD=.*/m', 'MAIL_PASSWORD="' . $appPasswordClean . '"', $envContent);

// Save .env
file_put_contents($envFile, $envContent);

echo "✓ File .env sudah diupdate!\n\n";

echo "Sekarang kita test email...\n";
echo "Tunggu sebentar...\n\n";

// Clear config
shell_exec('php artisan config:clear');

// Load Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('🎉 BERHASIL! Email notification Adakuu sudah aktif!', function ($message) {
        $message->to('zaki.alghifari0306@gmail.com')
                ->subject('✓ Test Email SMTP - Adakuu');
    });
    
    echo "====================================\n";
    echo "✅ SUKSES!\n";
    echo "====================================\n\n";
    echo "Email test sudah dikirim ke: zaki.alghifari0306@gmail.com\n";
    echo "Silakan cek inbox atau folder SPAM!\n\n";
    echo "Sistem email notification sudah AKTIF! 🚀\n";
    echo "Sekarang setiap checkout akan kirim email otomatis.\n\n";
    
} catch (Exception $e) {
    echo "====================================\n";
    echo "❌ GAGAL!\n";
    echo "====================================\n\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'BadCredentials') !== false) {
        echo "Kemungkinan penyebab:\n";
        echo "1. App Password salah\n";
        echo "2. 2-Factor Authentication belum aktif\n";
        echo "3. Email shoppinghere@shoppinghere.biz.id tidak bisa login\n\n";
        echo "Solusi:\n";
        echo "- Cek lagi App Password di: https://myaccount.google.com/apppasswords\n";
        echo "- Pastikan 2FA aktif di: https://myaccount.google.com/security\n";
        echo "- Generate App Password baru dan jalankan script ini lagi\n";
    }
}

<?php

echo "====================================\n";
echo "APPLY APP PASSWORD - ADAKUU\n";
echo "====================================\n\n";

// Read from input file
$inputFile = __DIR__ . '/input-app-password.txt';

if (!file_exists($inputFile)) {
    echo "❌ File input-app-password.txt tidak ditemukan!\n";
    exit(1);
}

$content = file_get_contents($inputFile);

// Extract password from file
preg_match('/APP_PASSWORD:\s*(.+)/', $content, $matches);

if (!isset($matches[1]) || empty(trim($matches[1]))) {
    echo "❌ APP_PASSWORD belum diisi!\n";
    echo "Buka file: input-app-password.txt\n";
    echo "Paste App Password dari Google di sana.\n";
    exit(1);
}

$appPassword = trim($matches[1]);

// Remove placeholder text
if (strpos($appPassword, '[PASTE') !== false || strpos($appPassword, 'abcd') !== false) {
    echo "❌ Kamu belum ganti placeholder dengan App Password asli!\n";
    echo "Buka file: input-app-password.txt\n";
    echo "Ganti [PASTE DI SINI] dengan App Password dari Google.\n";
    exit(1);
}

// Clean password (remove spaces)
$appPasswordClean = str_replace(' ', '', $appPassword);

echo "App Password ditemukan: {$appPassword}\n";
echo "App Password (cleaned): {$appPasswordClean}\n";
echo "Panjang: " . strlen($appPasswordClean) . " karakter\n\n";

if (strlen($appPasswordClean) !== 16) {
    echo "❌ App Password harus 16 karakter!\n";
    echo "Password kamu: " . strlen($appPasswordClean) . " karakter\n";
    exit(1);
}

echo "✓ Format App Password benar!\n\n";

// Update .env
$envFile = __DIR__ . '/.env';
$envContent = file_get_contents($envFile);

// Update MAIL settings
$envContent = preg_replace('/MAIL_MAILER=.*/m', 'MAIL_MAILER=smtp', $envContent);
$envContent = preg_replace('/MAIL_PASSWORD=.*/m', 'MAIL_PASSWORD="' . $appPasswordClean . '"', $envContent);

file_put_contents($envFile, $envContent);

echo "✓ File .env sudah diupdate!\n\n";

echo "Clearing config cache...\n";
shell_exec('php artisan config:clear 2>&1');
echo "✓ Cache cleared!\n\n";

echo "====================================\n";
echo "Testing email...\n";
echo "====================================\n\n";

// Load Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('🎉 SUKSES! Email notification Adakuu sudah aktif dengan Gmail SMTP!', function ($message) {
        $message->to('zaki.alghifari0306@gmail.com')
                ->subject('✅ Test Email SMTP Berhasil - Adakuu');
    });
    
    echo "====================================\n";
    echo "✅✅✅ BERHASIL! ✅✅✅\n";
    echo "====================================\n\n";
    echo "Email test sudah dikirim ke:\n";
    echo "→ zaki.alghifari0306@gmail.com\n\n";
    echo "Silakan cek:\n";
    echo "1. Inbox Gmail\n";
    echo "2. Folder SPAM (jika tidak ada di inbox)\n";
    echo "3. Tunggu 1-2 menit jika belum masuk\n\n";
    echo "Sistem email notification SUDAH AKTIF! 🚀\n";
    echo "Sekarang setiap checkout akan kirim email otomatis.\n\n";
    
} catch (Exception $e) {
    echo "====================================\n";
    echo "❌ GAGAL KIRIM EMAIL\n";
    echo "====================================\n\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'BadCredentials') !== false || strpos($e->getMessage(), '535') !== false) {
        echo "Kemungkinan penyebab:\n";
        echo "❌ App Password salah atau tidak valid\n";
        echo "❌ 2-Factor Authentication belum aktif\n";
        echo "❌ Email shoppinghere@shoppinghere.biz.id tidak bisa login\n\n";
        echo "Solusi:\n";
        echo "1. Generate App Password baru di Google\n";
        echo "2. Paste password baru di: input-app-password.txt\n";
        echo "3. Jalankan script ini lagi: php apply-app-password.php\n\n";
    } else {
        echo "Error lain. Cek:\n";
        echo "- Koneksi internet\n";
        echo "- Firewall tidak block port 587\n\n";
    }
}

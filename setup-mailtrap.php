<?php

echo "====================================\n";
echo "SETUP MAILTRAP SMTP - INTERACTIVE\n";
echo "====================================\n\n";

echo "Mailtrap adalah fake SMTP untuk development.\n";
echo "Email akan masuk ke inbox virtual di web dashboard.\n\n";

echo "Langkah Setup:\n";
echo "1. Buka: https://mailtrap.io/register/signup\n";
echo "2. Daftar (gratis)\n";
echo "3. Login\n";
echo "4. Klik 'Email Testing' → 'Inboxes' → 'My Inbox'\n";
echo "5. Tab 'SMTP Settings'\n";
echo "6. Copy credentials di bawah ini:\n\n";

echo "Masukkan Mailtrap Username: ";
$username = trim(fgets(STDIN));

echo "Masukkan Mailtrap Password: ";
$password = trim(fgets(STDIN));

if (empty($username) || empty($password)) {
    echo "\n❌ Username dan Password tidak boleh kosong!\n";
    exit(1);
}

echo "\n✓ Credentials diterima!\n\n";

// Read .env file
$envFile = __DIR__ . '/.env';
$envContent = file_get_contents($envFile);

// Replace MAIL settings
$envContent = preg_replace('/MAIL_MAILER=.*/m', 'MAIL_MAILER=smtp', $envContent);
$envContent = preg_replace('/MAIL_HOST=.*/m', 'MAIL_HOST=sandbox.smtp.mailtrap.io', $envContent);
$envContent = preg_replace('/MAIL_PORT=.*/m', 'MAIL_PORT=2525', $envContent);
$envContent = preg_replace('/MAIL_USERNAME=.*/m', 'MAIL_USERNAME=' . $username, $envContent);
$envContent = preg_replace('/MAIL_PASSWORD=.*/m', 'MAIL_PASSWORD="' . $password . '"', $envContent);
$envContent = preg_replace('/MAIL_ENCRYPTION=.*/m', 'MAIL_ENCRYPTION=tls', $envContent);

// Save .env
file_put_contents($envFile, $envContent);

echo "✓ File .env sudah diupdate dengan Mailtrap credentials!\n\n";

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
    Mail::raw('🎉 BERHASIL! Email notification Adakuu dengan Mailtrap sudah aktif!', function ($message) {
        $message->to('test@example.com')
                ->subject('✓ Test Email Mailtrap - Adakuu');
    });
    
    echo "====================================\n";
    echo "✅ SUKSES!\n";
    echo "====================================\n\n";
    echo "Email test sudah dikirim!\n\n";
    echo "Cara lihat email:\n";
    echo "1. Buka: https://mailtrap.io/\n";
    echo "2. Login\n";
    echo "3. Klik 'My Inbox'\n";
    echo "4. Lihat email yang baru masuk\n\n";
    echo "Sistem email notification sudah AKTIF! 🚀\n\n";
    
} catch (Exception $e) {
    echo "====================================\n";
    echo "❌ GAGAL!\n";
    echo "====================================\n\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    echo "Kemungkinan:\n";
    echo "- Username atau Password Mailtrap salah\n";
    echo "- Koneksi internet bermasalah\n\n";
}

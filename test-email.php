<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('Test email dari Adakuu - sistem notifikasi berfungsi!', function ($message) {
        $message->to('zaki.alghifari0306@gmail.com')
                ->subject('Test Email - Adakuu');
    });
    
    echo "✓ Email berhasil dikirim ke zaki.alghifari0306@gmail.com\n";
    echo "Silakan cek inbox atau folder spam Anda.\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "====================================\n";
echo "CREATE ADMIN USER\n";
echo "====================================\n\n";

$name = "Admin Zaki";
$email = "zakkaldev@gmail.com";
$password = "admin123";

// Check if user already exists
$existingUser = User::where('email', $email)->first();

if ($existingUser) {
    // Update to admin
    $existingUser->update(['role' => 'admin']);
    echo "✓ User sudah ada, diupdate jadi admin!\n\n";
    echo "Email: {$email}\n";
    echo "Role: admin\n\n";
    echo "Login di: http://localhost:8000/admin/login\n";
} else {
    // Create new admin
    User::create([
        'name' => $name,
        'email' => $email,
        'password' => bcrypt($password),
        'role' => 'admin',
    ]);
    
    echo "✓ Admin baru berhasil dibuat!\n\n";
    echo "Name: {$name}\n";
    echo "Email: {$email}\n";
    echo "Password: {$password}\n\n";
    echo "Login di: http://localhost:8000/admin/login\n";
}

echo "\n====================================\n";

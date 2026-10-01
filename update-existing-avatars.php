<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "====================================\n";
echo "UPDATE EXISTING USER AVATARS\n";
echo "====================================\n\n";

$users = User::all();

echo "Total users: {$users->count()}\n\n";

foreach ($users as $user) {
    echo "User: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Current Avatar: " . ($user->avatar ?? 'NULL') . "\n";
    echo "Avatar URL: {$user->avatar_url}\n";
    echo "---\n";
}

echo "\n✓ Done! Refresh halaman untuk lihat perubahan.\n";

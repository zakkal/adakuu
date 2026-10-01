<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "=== CHECK USER EMAILS ===\n\n";

$users = User::all();

foreach ($users as $user) {
    echo "ID: {$user->id}\n";
    echo "Name: {$user->name}\n";
    echo "Email: " . ($user->email ?? '❌ TIDAK ADA EMAIL') . "\n";
    echo "Role: {$user->role}\n";
    echo "---\n";
}

echo "\nTotal users: " . $users->count() . "\n";

<?php
/**
 * ADAKUU - Fix Permissions Script
 * Akses via browser: https://adakuu.web.id/fix-permissions.php
 * Hapus file ini setelah selesai!
 */

echo "<h1>🔧 Fixing Laravel Permissions...</h1>";
echo "<pre>";

$base = __DIR__;

$directories = [
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache',
];

foreach ($directories as $dir) {
    $path = $base . '/' . $dir;
    if (file_exists($path)) {
        if (@chmod($path, 0755)) {
            echo "✅ Fixed: $dir (755)\n";
        } else {
            echo "❌ Failed: $dir (Permission denied)\n";
        }
    } else {
        if (@mkdir($path, 0755, true)) {
            echo "✅ Created: $dir (755)\n";
        } else {
            echo "❌ Failed to create: $dir\n";
        }
    }
}

echo "\n";
echo "🎉 Done! Try accessing the site again.\n";
echo "\n⚠️  Don't forget to delete this file: fix-permissions.php\n";
echo "</pre>";
?>

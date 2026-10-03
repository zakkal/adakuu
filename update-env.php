<?php
/**
 * Emergency .env Updater for Production
 * 
 * Upload this file to: /home/zakkalmy/domains/adakuu.web.id/public_html/
 * Access via: https://adakuu.web.id/update-env.php
 * 
 * SECURITY: Delete this file after use!
 */

// Simple password protection
$correct_password = 'update-adakuu-2026';
$entered_password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $entered_password === $correct_password) {
    
    // Get credentials from POST (will be provided by user)
    $google_client_id = $_POST['google_client_id'] ?? '';
    $google_client_secret = $_POST['google_client_secret'] ?? '';
    
    if (empty($google_client_id) || empty($google_client_secret)) {
        die('<p style="color: red;">❌ Google Client ID and Secret are required!</p>');
    }
    
    // Read existing .env and get sensitive values
    $existing_env = file_exists(__DIR__ . '/.env') ? file_get_contents(__DIR__ . '/.env') : '';
    
    // Extract existing values using regex
    preg_match('/DB_PASSWORD=(.+)/', $existing_env, $db_pass_match);
    preg_match('/MAIL_PASSWORD=(.+)/', $existing_env, $mail_pass_match);
    preg_match('/MIDTRANS_SERVER_KEY=(.+)/', $existing_env, $midtrans_key_match);
    preg_match('/APP_KEY=(.+)/', $existing_env, $app_key_match);
    
    $db_password = $db_pass_match[1] ?? 'YOUR_DB_PASSWORD';
    $mail_password = $mail_pass_match[1] ?? 'YOUR_MAIL_PASSWORD';
    $midtrans_server_key = $midtrans_key_match[1] ?? 'YOUR_MIDTRANS_KEY';
    $app_key = $app_key_match[1] ?? 'base64:CcGGyYhDO61bHh5ua/eljxKY3u8t/8tv7Eo+zLSHZ0Q=';
    
    $env_content = <<<ENV
APP_NAME=Adakuu
APP_ENV=production
APP_KEY={$app_key}
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://adakuu.web.id

APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_FAKER_LOCALE=id_ID

APP_MAINTENANCE_DRIVER=file
BCRYPT_ROUNDS=12

LOG_CHANNEL=daily
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=zakkalmy_adakuu
DB_USERNAME=zakkalmy_adakuu
DB_PASSWORD={$db_password}

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=.adakuu.web.id
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=zakkaldev@gmail.com
MAIL_PASSWORD={$mail_password}
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@adakuu.com"
MAIL_FROM_NAME="Adakuu"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="\${APP_NAME}"

MIDTRANS_MERCHANT_ID=M061044719
MIDTRANS_CLIENT_KEY=Mid-client-r6EuuS4oG6-i3w3V
MIDTRANS_SERVER_KEY={$midtrans_server_key}
MIDTRANS_IS_PRODUCTION=true
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true

GOOGLE_CLIENT_ID={$google_client_id}
GOOGLE_CLIENT_SECRET={$google_client_secret}
GOOGLE_REDIRECT_URI="\${APP_URL}/auth/google/callback"
ENV;

    // Backup existing .env
    $env_file = __DIR__ . '/.env';
    if (file_exists($env_file)) {
        $backup_file = __DIR__ . '/.env.backup.' . date('Y-m-d_H-i-s');
        copy($env_file, $backup_file);
        echo "<p style='color: green;'>✅ Backup created: " . basename($backup_file) . "</p>";
    }
    
    // Write new .env
    if (file_put_contents($env_file, $env_content)) {
        echo "<p style='color: green;'><strong>✅ .env file updated successfully!</strong></p>";
        
        // Clear Laravel cache
        echo "<h3>Clearing Laravel cache...</h3>";
        
        $commands = [
            'php artisan config:clear',
            'php artisan cache:clear',
            'php artisan route:clear',
            'php artisan view:clear',
        ];
        
        foreach ($commands as $cmd) {
            $output = shell_exec("cd " . __DIR__ . " && $cmd 2>&1");
            echo "<p>$ $cmd<br><code style='background: #f5f5f5; padding: 5px; display: block;'>$output</code></p>";
        }
        
        echo "<hr>";
        echo "<p style='color: red; font-weight: bold;'>⚠️ PENTING: Sekarang hapus file update-env.php ini untuk keamanan!</p>";
        echo "<p><a href='/' style='padding: 10px 20px; background: red; color: white; text-decoration: none; border-radius: 5px;'>Kembali ke Homepage</a></p>";
        echo "<hr>";
        echo "<h3>🧪 Test Google OAuth Login</h3>";
        echo "<p>1. Buka browser <strong>Incognito/Private</strong></p>";
        echo "<p>2. Kunjungi: <a href='https://adakuu.web.id' target='_blank'>https://adakuu.web.id</a></p>";
        echo "<p>3. Klik tombol 'Login with Google'</p>";
        echo "<p>4. Pilih akun Google kamu</p>";
        echo "<p>5. Klik 'Continue'</p>";
        echo "<p>6. Cek apakah kamu berhasil login (avatar kamu muncul di navbar)</p>";
        
    } else {
        echo "<p style='color: red;'><strong>❌ Failed to write .env file!</strong></p>";
        echo "<p>Check file permissions: " . substr(sprintf('%o', fileperms(__DIR__)), -4) . "</p>";
    }
    
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update .env Production - Adakuu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #dc2626;
            margin-bottom: 20px;
        }
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #b91c1c;
        }
        .warning {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Update .env Production</h1>
        
        <div class="warning">
            <strong>⚠️ Warning:</strong>
            <p>This will update the production .env file with new session and Google OAuth settings.</p>
            <p><strong>Changes:</strong></p>
            <ul>
                <li>SESSION_DOMAIN=.adakuu.web.id</li>
                <li>SESSION_SECURE_COOKIE=true</li>
                <li>SESSION_SAME_SITE=lax</li>
                <li>GOOGLE_CLIENT_ID (updated)</li>
                <li>GOOGLE_CLIENT_SECRET (updated)</li>
                <li>APP_DEBUG=true (for troubleshooting)</li>
            </ul>
        </div>
        
        <form method="POST">
            <label for="password"><strong>Enter Password:</strong></label>
            <input type="password" name="password" id="password" placeholder="Password" required autofocus>
            
            <label for="google_client_id" style="margin-top: 15px; display: block;"><strong>Google Client ID:</strong></label>
            <input type="text" name="google_client_id" id="google_client_id" placeholder="xxxxxxx.apps.googleusercontent.com" required>
            
            <label for="google_client_secret" style="margin-top: 10px; display: block;"><strong>Google Client Secret:</strong></label>
            <input type="text" name="google_client_secret" id="google_client_secret" placeholder="GOCSPX-xxxxx" required>
            
            <button type="submit">Update .env & Clear Cache</button>
        </form>
        
        <p style="margin-top: 20px; color: #666; font-size: 14px;">
            Password: <code>update-adakuu-2026</code>
        </p>
        
        <hr style="margin: 30px 0;">
        
        <p style="color: #dc2626; font-weight: bold;">
            🗑️ JANGAN LUPA: Hapus file ini setelah selesai!
        </p>
    </div>
</body>
</html>

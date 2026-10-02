<?php
/**
 * ADAKUU - Web Installer
 * Akses via browser: https://adakuu.web.id/install.php
 * Hapus file ini setelah selesai install!
 */

// Security: Only allow access once
if (file_exists(__DIR__ . '/.installed')) {
    die('⚠️ Installation already completed. Delete .installed file to reinstall.');
}

// Configuration
$config = [
    'db_host' => 'localhost',
    'db_name' => 'adakuu_db',
    'db_user' => 'adakuu_user',
    'db_pass' => 'your_password',
    'app_url' => 'https://adakuu.web.id',
    'midtrans_server_key' => 'your_midtrans_server_key',
    'midtrans_client_key' => 'your_midtrans_client_key',
    'google_client_id' => 'your_google_client_id',
    'google_client_secret' => 'your_google_client_secret',
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adakuu - Web Installer</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }
        h1 {
            color: #dc2626;
            margin-bottom: 10px;
            font-size: 32px;
        }
        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }
        .step {
            background: #f9fafb;
            border-left: 4px solid #dc2626;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .step h3 {
            color: #1f2937;
            margin-bottom: 10px;
        }
        .step p {
            color: #6b7280;
            line-height: 1.6;
        }
        .status {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .status.pending { background: #fef3c7; border-left: 4px solid #f59e0b; }
        .status.success { background: #d1fae5; border-left: 4px solid #10b981; }
        .status.error { background: #fee2e2; border-left: 4px solid #ef4444; }
        .btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        .btn:hover { background: #b91c1c; }
        .code {
            background: #1f2937;
            color: #10b981;
            padding: 15px;
            border-radius: 8px;
            font-family: monospace;
            margin: 10px 0;
            overflow-x: auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1f2937;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Adakuu Installer</h1>
        <p class="subtitle">Setup otomatis Laravel application untuk production</p>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
            
            <form method="POST">
                <div class="step">
                    <h3>📊 Database Configuration</h3>
                    <div class="form-group">
                        <label>Database Host</label>
                        <input type="text" name="db_host" value="<?= $config['db_host'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Database Name</label>
                        <input type="text" name="db_name" value="<?= $config['db_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Database User</label>
                        <input type="text" name="db_user" value="<?= $config['db_user'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Database Password</label>
                        <input type="password" name="db_pass" value="<?= $config['db_pass'] ?>" required>
                    </div>
                </div>

                <div class="step">
                    <h3>🌐 Application URL</h3>
                    <div class="form-group">
                        <label>Full URL (dengan https://)</label>
                        <input type="url" name="app_url" value="<?= $config['app_url'] ?>" required>
                    </div>
                </div>

                <div class="step">
                    <h3>💳 Midtrans Configuration</h3>
                    <div class="form-group">
                        <label>Server Key (Production)</label>
                        <input type="text" name="midtrans_server_key" value="<?= $config['midtrans_server_key'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Client Key (Production)</label>
                        <input type="text" name="midtrans_client_key" value="<?= $config['midtrans_client_key'] ?>" required>
                    </div>
                </div>

                <div class="step">
                    <h3>🔐 Google OAuth</h3>
                    <div class="form-group">
                        <label>Client ID</label>
                        <input type="text" name="google_client_id" value="<?= $config['google_client_id'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Client Secret</label>
                        <input type="text" name="google_client_secret" value="<?= $config['google_client_secret'] ?>" required>
                    </div>
                </div>

                <button type="submit" class="btn">🚀 Install Sekarang</button>
            </form>

        <?php else: ?>
            
            <?php
            $config = [
                'db_host' => $_POST['db_host'],
                'db_name' => $_POST['db_name'],
                'db_user' => $_POST['db_user'],
                'db_pass' => $_POST['db_pass'],
                'app_url' => $_POST['app_url'],
                'midtrans_server_key' => $_POST['midtrans_server_key'],
                'midtrans_client_key' => $_POST['midtrans_client_key'],
                'google_client_id' => $_POST['google_client_id'],
                'google_client_secret' => $_POST['google_client_secret'],
            ];

            $steps = [];
            
            // Step 1: Create .env file
            try {
                $env_content = "APP_NAME=Adakuu
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL={$config['app_url']}

DB_CONNECTION=mysql
DB_HOST={$config['db_host']}
DB_PORT=3306
DB_DATABASE={$config['db_name']}
DB_USERNAME={$config['db_user']}
DB_PASSWORD={$config['db_pass']}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

MIDTRANS_SERVER_KEY={$config['midtrans_server_key']}
MIDTRANS_CLIENT_KEY={$config['midtrans_client_key']}
MIDTRANS_IS_PRODUCTION=true
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true

GOOGLE_CLIENT_ID={$config['google_client_id']}
GOOGLE_CLIENT_SECRET={$config['google_client_secret']}
GOOGLE_REDIRECT_URI={$config['app_url']}/auth/google/callback

MAIL_MAILER=log
LOG_CHANNEL=daily
LOG_LEVEL=error
";
                file_put_contents(__DIR__ . '/.env', $env_content);
                $steps[] = ['success', 'Create .env file', 'File .env berhasil dibuat'];
            } catch (Exception $e) {
                $steps[] = ['error', 'Create .env file', $e->getMessage()];
            }

            // Step 2: Generate app key
            try {
                $output = shell_exec('cd ' . __DIR__ . ' && php artisan key:generate --force 2>&1');
                $steps[] = ['success', 'Generate Application Key', $output ?: 'Key generated'];
            } catch (Exception $e) {
                $steps[] = ['error', 'Generate Application Key', $e->getMessage()];
            }

            // Step 3: Storage link
            try {
                $output = shell_exec('cd ' . __DIR__ . ' && php artisan storage:link 2>&1');
                $steps[] = ['success', 'Create Storage Link', $output ?: 'Storage linked'];
            } catch (Exception $e) {
                $steps[] = ['error', 'Create Storage Link', $e->getMessage()];
            }

            // Step 4: Set permissions
            try {
                chmod(__DIR__ . '/storage', 0755);
                chmod(__DIR__ . '/bootstrap/cache', 0755);
                $steps[] = ['success', 'Set Permissions', 'Permissions set to 755'];
            } catch (Exception $e) {
                $steps[] = ['error', 'Set Permissions', $e->getMessage()];
            }

            // Step 5: Run migrations
            try {
                $output = shell_exec('cd ' . __DIR__ . ' && php artisan migrate --force 2>&1');
                $steps[] = ['success', 'Run Migrations', $output ?: 'Migrations completed'];
            } catch (Exception $e) {
                $steps[] = ['error', 'Run Migrations', $e->getMessage()];
            }

            // Step 6: Seed database
            try {
                $output = shell_exec('cd ' . __DIR__ . ' && php artisan db:seed --force 2>&1');
                $steps[] = ['success', 'Seed Database', $output ?: 'Database seeded'];
            } catch (Exception $e) {
                $steps[] = ['error', 'Seed Database', $e->getMessage()];
            }

            // Step 7: Optimize
            try {
                shell_exec('cd ' . __DIR__ . ' && php artisan config:cache 2>&1');
                shell_exec('cd ' . __DIR__ . ' && php artisan route:cache 2>&1');
                shell_exec('cd ' . __DIR__ . ' && php artisan view:cache 2>&1');
                $steps[] = ['success', 'Optimize Application', 'Config, routes, and views cached'];
            } catch (Exception $e) {
                $steps[] = ['error', 'Optimize Application', $e->getMessage()];
            }

            // Display results
            foreach ($steps as $step) {
                [$status, $title, $message] = $step;
                echo "<div class='status {$status}'>";
                echo "<strong>{$title}</strong><br>";
                echo "<pre style='margin-top: 10px; white-space: pre-wrap;'>{$message}</pre>";
                echo "</div>";
            }

            // Create installed flag
            file_put_contents(__DIR__ . '/.installed', date('Y-m-d H:i:s'));
            ?>

            <div class="step">
                <h3>✅ Installation Complete!</h3>
                <p><strong>Default Admin Login:</strong></p>
                <div class="code">
Email: admin@adakuu.com<br>
Password: password
                </div>
                <p style="margin-top: 15px; color: #dc2626; font-weight: 600;">
                    ⚠️ WAJIB GANTI PASSWORD SETELAH LOGIN!
                </p>
                <p style="margin-top: 15px;">
                    <strong>Jangan lupa:</strong><br>
                    1. Hapus file <code>install.php</code> ini untuk keamanan<br>
                    2. Setup webhook Midtrans: <?= $config['app_url'] ?>/api/payment/webhook<br>
                    3. Setup Google OAuth redirect: <?= $config['app_url'] ?>/auth/google/callback
                </p>
            </div>

            <a href="/" class="btn">🎉 Buka Website</a>

        <?php endif; ?>
    </div>
</body>
</html>

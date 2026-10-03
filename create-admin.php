<?php
/**
 * Create Admin User Script
 * 
 * Upload this file to: /home/zakkalmy/domains/adakuu.web.id/public_html/
 * Access via: https://adakuu.web.id/create-admin.php
 * 
 * SECURITY: Delete this file after use!
 */

// Simple password protection
$correct_password = 'create-admin-2026';
$entered_password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $entered_password === $correct_password) {
    
    // Bootstrap Laravel
    require __DIR__.'/vendor/autoload.php';
    $app = require_once __DIR__.'/bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    // Admin details
    $adminEmail = $_POST['email'] ?? 'admin@adakuu.com';
    $adminPassword = $_POST['admin_password'] ?? 'adminadakuu03';
    $adminName = $_POST['name'] ?? 'Administrator';
    
    try {
        // Check if admin already exists
        $existingAdmin = \App\Models\User::where('email', $adminEmail)->first();
        
        if ($existingAdmin) {
            // Update existing admin
            $existingAdmin->update([
                'name' => $adminName,
                'password' => bcrypt($adminPassword),
                'role' => 'admin',
            ]);
            
            echo "<div style='padding: 20px; background: #fef3c7; border-left: 4px solid #f59e0b; margin: 20px 0;'>";
            echo "<strong>⚠️ Admin user already exists - Password updated!</strong><br>";
            echo "<p>Email: <code>{$adminEmail}</code><br>";
            echo "New Password: <code>{$adminPassword}</code><br>";
            echo "Role: <strong>admin</strong></p>";
            echo "</div>";
            
        } else {
            // Create new admin
            $admin = \App\Models\User::create([
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => bcrypt($adminPassword),
                'role' => 'admin',
            ]);
            
            echo "<div style='padding: 20px; background: #d1fae5; border-left: 4px solid #059669; margin: 20px 0;'>";
            echo "<strong>✅ Admin user created successfully!</strong><br>";
            echo "<p>Name: <strong>{$admin->name}</strong><br>";
            echo "Email: <code>{$admin->email}</code><br>";
            echo "Password: <code>{$adminPassword}</code><br>";
            echo "Role: <strong>{$admin->role}</strong><br>";
            echo "ID: {$admin->id}</p>";
            echo "</div>";
        }
        
        echo "<hr>";
        echo "<h3>🎯 Next Steps:</h3>";
        echo "<ol>";
        echo "<li><strong>Login to Admin Panel:</strong> <a href='/login' target='_blank'>https://adakuu.web.id/login</a></li>";
        echo "<li>Use email: <code>{$adminEmail}</code></li>";
        echo "<li>Use password: <code>{$adminPassword}</code></li>";
        echo "<li><strong style='color: red;'>DELETE this file (create-admin.php) for security!</strong></li>";
        echo "</ol>";
        
        echo "<hr>";
        echo "<p><a href='/login' style='padding: 10px 20px; background: #dc2626; color: white; text-decoration: none; border-radius: 5px;'>Go to Login Page</a></p>";
        
    } catch (\Exception $e) {
        echo "<div style='padding: 20px; background: #fecdd3; border-left: 4px solid #dc2626; margin: 20px 0;'>";
        echo "<strong>❌ Error creating admin user:</strong><br>";
        echo "<code>" . htmlspecialchars($e->getMessage()) . "</code>";
        echo "</div>";
        
        echo "<p><strong>Possible solutions:</strong></p>";
        echo "<ul>";
        echo "<li>Check database connection in .env file</li>";
        echo "<li>Make sure users table exists (run migrations)</li>";
        echo "<li>Check file permissions</li>";
        echo "</ul>";
    }
    
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Admin User - Adakuu</title>
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
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
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
            margin-top: 15px;
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
        .info {
            background: #dbeafe;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>👤 Create Admin User</h1>
        
        <div class="warning">
            <strong>⚠️ Security Notice:</strong>
            <p>This script will create or update an admin user in the database.</p>
            <p><strong style="color: red;">DELETE this file after use!</strong></p>
        </div>
        
        <form method="POST">
            <label for="password">Script Password:</label>
            <input type="password" name="password" id="password" placeholder="Script password" required autofocus>
            
            <label for="name">Admin Name:</label>
            <input type="text" name="name" id="name" value="Administrator" required>
            
            <label for="email">Admin Email:</label>
            <input type="email" name="email" id="email" value="admin@adakuu.com" required>
            
            <label for="admin_password">Admin Password:</label>
            <input type="text" name="admin_password" id="admin_password" value="adminadakuu03" required>
            
            <button type="submit">Create / Update Admin User</button>
        </form>
        
        <div class="info">
            <strong>ℹ️ Instructions:</strong>
            <ol style="margin: 10px 0; padding-left: 20px;">
                <li>Enter script password: <code>create-admin-2026</code></li>
                <li>Fill in admin details (or use defaults)</li>
                <li>Click "Create / Update Admin User"</li>
                <li>Delete this file after success!</li>
            </ol>
        </div>
        
        <hr style="margin: 30px 0;">
        
        <p style="color: #dc2626; font-weight: bold;">
            🗑️ REMEMBER: Delete this file after creating admin!
        </p>
    </div>
</body>
</html>

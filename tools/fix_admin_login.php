<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

echo "=== Fixing Admin Login ===\n\n";

$email = 'admin@wisatanusantara.com';
$password = 'admin123';

// First, let's check if is_admin column exists
echo "Checking database structure...\n";
$columns = DB::select("SHOW COLUMNS FROM users");
$hasIsAdmin = false;

foreach ($columns as $column) {
    if ($column->Field === 'is_admin') {
        $hasIsAdmin = true;
        break;
    }
}

echo "is_admin column exists: " . ($hasIsAdmin ? 'Yes' : 'No') . "\n\n";

// Find or create admin user
$user = User::where('email', $email)->first();

if ($user) {
    echo "✓ User found: {$user->name} ({$user->email})\n";
    echo "Updating password...\n";
    
    // Update password
    $user->password = Hash::make($password);
    
    // Update is_admin if column exists
    if ($hasIsAdmin) {
        $user->is_admin = true;
        echo "Setting is_admin = true\n";
    }
    
    $user->save();
    echo "✓ User updated!\n";
} else {
    echo "Creating new admin user...\n";
    
    $userData = [
        'name' => 'Admin',
        'email' => $email,
        'password' => Hash::make($password),
    ];
    
    if ($hasIsAdmin) {
        $userData['is_admin'] = true;
    }
    
    $user = User::create($userData);
    echo "✓ Admin user created!\n";
}

echo "\n=== Login Credentials ===\n";
echo "Email: {$email}\n";
echo "Password: {$password}\n";
echo "Login URL: http://localhost/projek%202/admin/login\n";
echo "\nNote: Access is granted based on email in canAccessPanel() method.\n";

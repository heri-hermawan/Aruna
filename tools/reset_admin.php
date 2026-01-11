<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== Admin User Reset Tool ===\n\n";

$email = 'admin@wisatanusantara.com';
$password = 'admin123';

// Check if user exists
$user = User::where('email', $email)->first();

if ($user) {
    echo "User found with email: {$email}\n";
    echo "Current user details:\n";
    echo "- ID: {$user->id}\n";
    echo "- Name: {$user->name}\n";
    echo "- Email: {$user->email}\n";
    echo "- Is Admin: " . ($user->is_admin ? 'Yes' : 'No') . "\n";
    echo "\nUpdating password and ensuring admin status...\n";
    
    $user->password = Hash::make($password);
    $user->is_admin = true;
    $user->name = 'Admin';
    $user->save();
    
    echo "✓ User updated successfully!\n";
} else {
    echo "User not found. Creating new admin user...\n";
    
    $user = User::create([
        'name' => 'Admin',
        'email' => $email,
        'password' => Hash::make($password),
        'is_admin' => true,
    ]);
    
    echo "✓ Admin user created successfully!\n";
}

echo "\n=== Login Credentials ===\n";
echo "Email: {$email}\n";
echo "Password: {$password}\n";
echo "\nYou can now login at: http://localhost/projek%202/admin/login\n";

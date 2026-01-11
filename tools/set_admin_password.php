<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

echo "═══════════════════════════════════════════\n";
echo "   ADMIN PASSWORD SETTER\n";
echo "═══════════════════════════════════════════\n\n";

$email = 'admin@wisatanusantara.com';

// Set password to 'password' as shown in the screenshot
$newPassword = 'password';

echo "Setting up admin account...\n\n";

// Delete existing user if exists
$existingUser = User::where('email', $email)->first();
if ($existingUser) {
    echo "⚠️  Deleting existing user...\n";
    $existingUser->delete();
}

// Create fresh admin user
echo "✓ Creating new admin user\n";
$user = User::create([
    'name' => 'Admin',
    'email' => $email,
    'password' => Hash::make($newPassword),
]);

echo "✓ Admin user created successfully!\n\n";

// Verify the password works
echo "Testing authentication...\n";
$testAuth = Auth::attempt([
    'email' => $email,
    'password' => $newPassword,
]);

if ($testAuth) {
    echo "✓ Authentication test PASSED!\n";
    Auth::logout();
} else {
    echo "✗ Authentication test FAILED!\n";
    exit(1);
}

echo "\n═══════════════════════════════════════════\n";
echo "   ✅ READY TO LOGIN!\n";
echo "═══════════════════════════════════════════\n\n";
echo "Email:    {$email}\n";
echo "Password: {$newPassword}\n";
echo "URL:      http://127.0.0.1:8000/admin/login\n\n";
echo "═══════════════════════════════════════════\n";

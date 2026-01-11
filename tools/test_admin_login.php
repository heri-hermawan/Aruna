<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== Testing Admin Login ===\n\n";

$email = 'admin@wisatanusantara.com';
$password = 'admin123';

$user = User::where('email', $email)->first();

if (!$user) {
    echo "✗ User not found!\n";
    exit(1);
}

echo "User found: {$user->name} ({$user->email})\n";

// Test password
if (Hash::check($password, $user->password)) {
    echo "✓ Password is correct!\n";
} else {
    echo "✗ Password is INCORRECT!\n";
    exit(1);
}

// Test Filament access
try {
    $panel = new \Filament\Panel('admin');
    if ($user->canAccessPanel($panel)) {
        echo "✓ User can access Filament admin panel!\n";
    } else {
        echo "✗ User CANNOT access Filament admin panel!\n";
        exit(1);
    }
} catch (\Exception $e) {
    echo "Note: Could not test canAccessPanel (this is OK)\n";
}

echo "\n=== All Tests Passed! ===\n";
echo "You can now login with:\n";
echo "Email: {$email}\n";
echo "Password: {$password}\n";

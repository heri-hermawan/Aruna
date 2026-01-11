<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

echo "=== Testing Authentication Directly ===\n\n";

$email = 'admin@wisatanusantara.com';
$password = 'admin123';

// 1. Get user
$user = User::where('email', $email)->first();

if (!$user) {
    echo "✗ User not found!\n";
    exit(1);
}

echo "User: {$user->name} ({$user->email})\n";
echo "Password hash: " . substr($user->password, 0, 30) . "...\n\n";

// 2. Test password with Hash::check
echo "Testing with Hash::check():\n";
$hashCheck = Hash::check($password, $user->password);
echo "Result: " . ($hashCheck ? "✓ SUCCESS" : "✗ FAILED") . "\n\n";

// 3. Test with Auth::attempt
echo "Testing with Auth::attempt():\n";
$credentials = [
    'email' => $email,
    'password' => $password,
];

try {
    $authResult = Auth::attempt($credentials);
    echo "Result: " . ($authResult ? "✓ SUCCESS" : "✗ FAILED") . "\n";
    
    if ($authResult) {
        echo "Authenticated user: " . Auth::user()->email . "\n";
        Auth::logout();
    }
} catch (\Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
}
echo "\n";

// 4. Try with different password to ensure it's working
echo "Testing with WRONG password (should fail):\n";
$wrongResult = Auth::attempt([
    'email' => $email,
    'password' => 'wrongpassword123',
]);
echo "Result: " . ($wrongResult ? "✗ INCORRECTLY SUCCEEDED" : "✓ CORRECTLY FAILED") . "\n\n";

// 5. Delete and recreate user
echo "=== Recreating User from Scratch ===\n";
$user->delete();
echo "✓ Old user deleted\n";

$newUser = User::create([
    'name' => 'Admin',
    'email' => $email,
    'password' => Hash::make($password),
]);

echo "✓ New user created (ID: {$newUser->id})\n";

// Test new user
echo "\nTesting new user authentication:\n";
$newAuthResult = Auth::attempt($credentials);
echo "Result: " . ($newAuthResult ? "✓ SUCCESS" : "✗ FAILED") . "\n";

if ($newAuthResult) {
    echo "\n✅ SUCCESS! Admin login is now working!\n";
    echo "\nCredentials:\n";
    echo "Email: {$email}\n";
    echo "Password: {$password}\n";
    Auth::logout();
} else {
    echo "\n✗ Still failed. There might be a deeper issue.\n";
}

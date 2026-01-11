<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

echo "=== Deep Admin Login Investigation ===\n\n";

$email = 'admin@wisatanusantara.com';
$password = 'admin123';

// 1. Check database columns
echo "1. Database Structure:\n";
$columns = DB::select("SHOW COLUMNS FROM users");
foreach ($columns as $column) {
    echo "   - {$column->Field} ({$column->Type})\n";
}
echo "\n";

// 2. Find user
echo "2. User Details:\n";
$user = User::where('email', $email)->first();

if (!$user) {
    echo "   ✗ User NOT found!\n\n";
    
    // Show all users
    echo "All users in database:\n";
    $users = User::all();
    foreach ($users as $u) {
        echo "   - ID: {$u->id}, Email: {$u->email}, Name: {$u->name}\n";
    }
    exit(1);
}

echo "   ✓ User found!\n";
echo "   - ID: {$user->id}\n";
echo "   - Name: {$user->name}\n";
echo "   - Email: {$user->email}\n";

// Check all attributes
$attributes = $user->getAttributes();
foreach ($attributes as $key => $value) {
    if ($key !== 'password') {
        echo "   - {$key}: " . (is_null($value) ? 'NULL' : $value) . "\n";
    } else {
        echo "   - password: [HASH] " . substr($value, 0, 20) . "...\n";
    }
}
echo "\n";

// 3. Test password
echo "3. Password Test:\n";
echo "   Testing password: '{$password}'\n";
$passwordMatches = Hash::check($password, $user->password);
echo "   Result: " . ($passwordMatches ? "✓ MATCHES" : "✗ DOES NOT MATCH") . "\n\n";

// 4. Test different passwords
echo "4. Testing Common Passwords:\n";
$testPasswords = ['admin123', 'password', 'admin', '12345678', 'admin@wisatanusantara.com'];
foreach ($testPasswords as $testPwd) {
    $matches = Hash::check($testPwd, $user->password);
    echo "   - '{$testPwd}': " . ($matches ? "✓ MATCH" : "✗ NO MATCH") . "\n";
}
echo "\n";

// 5. Check auth config
echo "5. Auth Configuration:\n";
echo "   - Default guard: " . config('auth.defaults.guard') . "\n";
echo "   - Guard driver: " . config('auth.guards.web.driver') . "\n";
echo "   - User provider: " . config('auth.guards.web.provider') . "\n";
echo "   - Provider model: " . config('auth.providers.users.model') . "\n";
echo "\n";

// 6. Fresh password hash test
echo "6. Creating Fresh Hash:\n";
$freshHash = Hash::make($password);
echo "   New hash created: " . substr($freshHash, 0, 30) . "...\n";
echo "   Testing new hash: " . (Hash::check($password, $freshHash) ? "✓ WORKS" : "✗ FAILED") . "\n";
echo "\n";

// 7. Update with fresh hash
echo "7. Re-saving User with Fresh Hash:\n";
$user->password = $freshHash;
$saved = $user->save();
echo "   Save result: " . ($saved ? "✓ SUCCESS" : "✗ FAILED") . "\n";

// Verify
$user->refresh();
echo "   Verification: " . (Hash::check($password, $user->password) ? "✓ PASSWORD CORRECT" : "✗ PASSWORD WRONG") . "\n";

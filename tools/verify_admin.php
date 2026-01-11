<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=== Final Verification ===\n\n";

$email = 'admin@wisatanusantara.com';
$password = 'admin123';

// Check user exists
$user = User::where('email', $email)->first();
echo "User: " . ($user ? "✓ Found" : "✗ Not Found") . "\n";

if ($user) {
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    
    // Test login
    $authResult = Auth::attempt(['email' => $email, 'password' => $password]);
    echo "Auth Test: " . ($authResult ? "✓ SUCCESS" : "✗ FAILED") . "\n";
    
    if ($authResult) {
        // Test Filament access
        $panel = new \Filament\Panel('admin');
        $canAccess = $user->canAccessPanel($panel);
        echo "Can Access Panel: " . ($canAccess ? "✓ YES"  : "✗ NO") . "\n";
        
        Auth::logout();
        
        echo "\n✅ ALL CHECKS PASSED!\n";
        echo "\nLogin Credentials:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "Email:    {$email}\n";
        echo "Password: {$password}\n";
        echo "URL:      http://127.0.0.1:8000/admin/login\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    }
}

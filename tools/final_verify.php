<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

echo "\n";
echo "╔════════════════════════════════════════════════╗\n";
echo "║        FINAL LOGIN VERIFICATION                ║\n";
echo "╚════════════════════════════════════════════════╝\n\n";

$email = 'admin@wisatanusantara.com';
$password = 'password';

// 1. Check user exists
$user = User::where('email', $email)->first();

if (!$user) {
    echo "❌ GAGAL: User tidak ditemukan!\n";
    exit(1);
}

echo "✅ User ditemukan:\n";
echo "   - ID: {$user->id}\n";
echo "   - Name: {$user->name}\n";
echo "   - Email: {$user->email}\n\n";

// 2. Test password dengan Hash::check
echo "Testing password dengan Hash::check()...\n";
$hashCheck = Hash::check($password, $user->password);
if ($hashCheck) {
    echo "   ✅ Password COCOK!\n\n";
} else {
    echo "   ❌ Password TIDAK COCOK!\n\n";
    exit(1);
}

// 3. Test dengan Auth::attempt (cara yang digunakan Filament)
echo "Testing login dengan Auth::attempt()...\n";
$authResult = Auth::attempt([
    'email' => $email,
    'password' => $password,
]);

if ($authResult) {
    echo "   ✅ Auth::attempt() BERHASIL!\n\n";
    Auth::logout();
} else {
    echo "   ❌ Auth::attempt() GAGAL!\n\n";
    exit(1);
}

// 4. Test Filament panel access
echo "Testing Filament panel access...\n";
$panel = new \Filament\Panel('admin');
$canAccess = $user->canAccessPanel($panel);

if ($canAccess) {
    echo "   ✅ User BISA akses Filament panel!\n\n";
} else {
    echo "   ❌ User TIDAK BISA akses Filament panel!\n\n";
    exit(1);
}

// All passed!
echo "╔════════════════════════════════════════════════╗\n";
echo "║           ✅ SEMUA TEST BERHASIL!              ║\n";
echo "╚════════════════════════════════════════════════╝\n\n";

echo "📋 CREDENTIALS UNTUK LOGIN:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "Email:    {$email}\n";
echo "Password: {$password}\n";
echo "URL:      http://127.0.0.1:8000/admin/login\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

echo "⚠️  PENTING:\n";
echo "   - Gunakan browser INCOGNITO/PRIVATE mode\n";
echo "   - Atau clear cookies/cache browser Anda\n";
echo "   - Pastikan server sudah running: php artisan serve\n\n";

echo "🔄 Refresh halaman login dan coba lagi!\n\n";

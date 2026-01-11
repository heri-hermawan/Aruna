<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

echo "=== Checking Admin User ===\n\n";

$email = 'admin@wisatanusantara.com';
$user = User::where('email', $email)->first();

if ($user) {
    echo "✓ Admin user found!\n";
    echo "- ID: {$user->id}\n";
    echo "- Name: {$user->name}\n";
    echo "- Email: {$user->email}\n";
    echo "- Is Admin: " . ($user->is_admin ? 'Yes' : 'No') . "\n";
} else {
    echo "✗ Admin user NOT found!\n";
}

echo "\nTotal users in database: " . User::count() . "\n";

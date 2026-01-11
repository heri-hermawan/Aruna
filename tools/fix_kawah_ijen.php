<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== FIXING KAWAH IJEN IMAGE ===\n\n";

// Find Kawah Ijen in database
$wisata = DB::table('wisata')
    ->where('name', 'like', '%Kawah Ijen%')
    ->first();

if (!$wisata) {
    echo "❌ Kawah Ijen not found in database!\n";
    exit(1);
}

echo "Found wisata:\n";
echo "  ID: {$wisata->id}\n";
echo "  Name: {$wisata->name}\n";
echo "  Province: {$wisata->province}\n";
echo "  Current image: " . ($wisata->image ?: 'NULL') . "\n\n";

// Check if image file exists
$imagePath = 'images/wisata/kawah_ijen_1767529778.png';
$fullPath = public_path($imagePath);

if (!file_exists($fullPath)) {
    echo "❌ Image file not found: {$fullPath}\n";
    exit(1);
}

echo "✓ Image file exists: {$imagePath}\n\n";

// Update database
$updated = DB::table('wisata')
    ->where('id', $wisata->id)
    ->update(['image' => $imagePath]);

if ($updated) {
    echo "✅ Successfully updated Kawah Ijen image!\n";
    echo "   Image path: {$imagePath}\n";
} else {
    echo "❌ Failed to update database\n";
    exit(1);
}

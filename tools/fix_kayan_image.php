<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Wisata;

echo "=== FIXING TAMAN NASIONAL KAYAN MENTARANG IMAGE ===" . PHP_EOL . PHP_EOL;

// Find the wisata
$wisata = Wisata::where('name', 'Taman Nasional Kayan Mentarang')->first();

if (!$wisata) {
    echo "✗ Wisata 'Taman Nasional Kayan Mentarang' not found!" . PHP_EOL;
    exit(1);
}

echo "✓ Found wisata:" . PHP_EOL;
echo "  ID: {$wisata->id}" . PHP_EOL;
echo "  Name: {$wisata->name}" . PHP_EOL;
echo "  Province: {$wisata->province->name}" . PHP_EOL;
echo "  Current Image: " . ($wisata->image ?: 'NULL') . PHP_EOL;
echo PHP_EOL;

// Update the image path
$imagePath = 'images/wisata/Taman Nasional Kayan Mentarang.webp';
$fullPath = public_path($imagePath);

if (!file_exists($fullPath)) {
    echo "✗ Image file not found at: {$fullPath}" . PHP_EOL;
    exit(1);
}

echo "✓ Image file exists at: {$fullPath}" . PHP_EOL;
echo PHP_EOL;

// Update the database
$wisata->image = $imagePath;
$wisata->save();

echo "✓ Successfully updated image path in database!" . PHP_EOL;
echo "  New image path: {$wisata->image}" . PHP_EOL;
echo PHP_EOL;
echo "The wisata should now display on the website with its image." . PHP_EOL;

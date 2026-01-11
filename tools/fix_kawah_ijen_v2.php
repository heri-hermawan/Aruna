<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== FIXING KAWAH IJEN IMAGE ===\n\n";

// Step 1: Check current state
$wisata = DB::table('wisata')->where('name', 'like', '%Kawah Ijen%')->first();

if (!$wisata) {
    echo "ERROR: Kawah Ijen not found in database!\n";
    exit(1);
}

echo "1. Current Database Record:\n";
echo "   ID: {$wisata->id}\n";
echo "   Name: {$wisata->name}\n";
echo "   Province: {$wisata->province}\n";
echo "   Current Image: " . ($wisata->image ?: '(NULL)') . "\n\n";

// Step 2: Check for image file
$imageFiles = [
    'images/wisata/kawah_ijen_1767529778.png',
    'images/wisata/Kawah Ijen.jpg',
    'images/wisata/Kawah Ijen.png',
];

$foundImage = null;
foreach ($imageFiles as $imagePath) {
    if (file_exists(public_path($imagePath))) {
        $foundImage = $imagePath;
        break;
    }
}

if (!$foundImage) {
    echo "2. ERROR: No image file found for Kawah Ijen!\n";
    echo "   Checked paths:\n";
    foreach ($imageFiles as $path) {
        echo "   - {$path}\n";
    }
    exit(1);
}

echo "2. Found Image File:\n";
echo "   Path: {$foundImage}\n";
echo "   Full Path: " . public_path($foundImage) . "\n";
echo "   File Size: " . filesize(public_path($foundImage)) . " bytes\n\n";

// Step 3: Update database
echo "3. Updating Database...\n";
$updated = DB::table('wisata')
    ->where('id', $wisata->id)
    ->update(['image' => $foundImage]);

if ($updated) {
    echo "   ✅ SUCCESS! Updated image path\n\n";
    
    // Verify the update
    $verified = DB::table('wisata')->where('id', $wisata->id)->first();
    echo "4. Verified Record:\n";
    echo "   Image: {$verified->image}\n";
} else {
    echo "   ⚠️ No rows updated (maybe image was already set?)\n";
}

echo "\nDONE!\n";

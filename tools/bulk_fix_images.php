<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Wisata;

echo "=== BULK FIXING WISATA IMAGES ===" . PHP_EOL . PHP_EOL;

// Read the matched images JSON file
$matchedFile = __DIR__ . '/matched_images.json';

if (!file_exists($matchedFile)) {
    echo "✗ matched_images.json not found! Run check_all_missing_images.php first." . PHP_EOL;
    exit(1);
}

$matched = json_decode(file_get_contents($matchedFile), true);

if (empty($matched)) {
    echo "✗ No matched images found to fix." . PHP_EOL;
    exit(0);
}

echo "Found " . count($matched) . " wisata(s) to fix:" . PHP_EOL . PHP_EOL;

$successCount = 0;
$errorCount = 0;

foreach ($matched as $item) {
    $wisata = Wisata::find($item['id']);
    
    if (!$wisata) {
        echo "✗ Wisata ID {$item['id']} not found!" . PHP_EOL;
        $errorCount++;
        continue;
    }
    
    $imagePath = 'images/wisata/' . $item['file'];
    $fullPath = public_path($imagePath);
    
    if (!file_exists($fullPath)) {
        echo "✗ Image file not found: {$fullPath}" . PHP_EOL;
        $errorCount++;
        continue;
    }
    
    // Update the database
    $wisata->image = $imagePath;
    $wisata->save();
    
    echo "✓ Fixed: {$wisata->name} ({$wisata->province->name})" . PHP_EOL;
    echo "  Image: {$imagePath}" . PHP_EOL . PHP_EOL;
    $successCount++;
}

echo PHP_EOL;
echo "=== SUMMARY ===" . PHP_EOL;
echo "Successfully updated: {$successCount}" . PHP_EOL;
echo "Errors: {$errorCount}" . PHP_EOL;
echo PHP_EOL;

if ($successCount > 0) {
    echo "All wisata images have been successfully linked! 🎉" . PHP_EOL;
}

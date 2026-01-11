<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Wisata;
use Illuminate\Support\Facades\Storage;

$output = [];

$output[] = "=== CHECKING ALL WISATA WITH MISSING IMAGES ===";
$output[] = "";

// Get all image files in the wisata folder
$publicPath = public_path('images/wisata');
$imageFiles = [];

if (is_dir($publicPath)) {
    $files = scandir($publicPath);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && !is_dir($publicPath . '/' . $file)) {
            // Remove extension to get the base name
            $baseName = pathinfo($file, PATHINFO_FILENAME);
            $imageFiles[$baseName] = $file;
        }
    }
}

$output[] = "✓ Found " . count($imageFiles) . " image files in public/images/wisata/";
$output[] = "";

// Get all wisata with NULL images
$wisatasWithNullImage = Wisata::whereNull('image')->orWhere('image', '')->get();

$output[] = "Found {$wisatasWithNullImage->count()} wisata(s) with NULL/empty image in database:";
$output[] = "";

$matchedCount = 0;
$matched = [];

foreach ($wisatasWithNullImage as $wisata) {
    $hasMatchingFile = false;
    $matchedFile = null;
    
    // Try exact match
    if (isset($imageFiles[$wisata->name])) {
        $hasMatchingFile = true;
        $matchedFile = $imageFiles[$wisata->name];
    }
    
    if ($hasMatchingFile) {
        $matchedCount++;
        $matched[] = [
            'id' => $wisata->id,
            'name' => $wisata->name,
            'province' => $wisata->province->name,
            'file' => $matchedFile
        ];
        $output[] = "  ✓ MATCH - ID: {$wisata->id} | {$wisata->name} ({$wisata->province->name})";
        $output[] = "           File: {$matchedFile}";
    } else {
        $output[] = "  ✗ NO MATCH - ID: {$wisata->id} | {$wisata->name} ({$wisata->province->name})";
    }
}

$output[] = "";
$output[] = "=== SUMMARY ===";
$output[] = "Total wisata with NULL images: {$wisatasWithNullImage->count()}";
$output[] = "Wisata with matching image files: {$matchedCount}";
$output[] = "";

if ($matchedCount > 0) {
    $output[] = "These wisata can be automatically fixed:";
    foreach ($matched as $m) {
        $output[] = "  - {$m['name']} -> images/wisata/{$m['file']}";
    }
}

// Write to file
$outputText = implode(PHP_EOL, $output);
file_put_contents(__DIR__ . '/all_missing_images.txt', $outputText);

echo $outputText;

// Also return the matched data as JSON for the fix script
file_put_contents(__DIR__ . '/matched_images.json', json_encode($matched, JSON_PRETTY_PRINT));

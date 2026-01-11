<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Wisata;
use App\Models\Province;

$output = [];

$output[] = "=== CHECKING TAMAN NASIONAL KAYAN MENTARANG ===";
$output[] = "";

// Check if any wisata contains "Kayan" or "Mentarang"
$wisatas = Wisata::where('name', 'like', '%Kayan%')
    ->orWhere('name', 'like', '%Mentarang%')
    ->get();

if ($wisatas->count() > 0) {
    $output[] = "✓ Found {$wisatas->count()} wisata(s) matching 'Kayan' or 'Mentarang':";
    foreach ($wisatas as $wisata) {
        $output[] = "  - ID: {$wisata->id}";
        $output[] = "    Name: {$wisata->name}";
        $output[] = "    Province: " . ($wisata->province ? $wisata->province->name : 'N/A');
        $output[] = "    Image: " . ($wisata->image ?: 'NULL');
        $output[] = "";
    }
} else {
    $output[] = "✗ NO wisata found matching 'Kayan' or 'Mentarang'";
    $output[] = "";
    $output[] = "This means the data is NOT in the database yet.";
    $output[] = "The image file exists at: public/images/wisata/Taman Nasional Kayan Mentarang.webp";
    $output[] = "";
}

// Total wisata count
$total = Wisata::count();
$output[] = "Total wisata in database: {$total}";
$output[] = "";

// Write to file
$outputText = implode(PHP_EOL, $output);
file_put_contents(__DIR__ . '/kayan_check_result.txt', $outputText);

echo $outputText;

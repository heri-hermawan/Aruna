<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Wisata;

$output = [];

$output[] = "=== CHECKING DANAU TONDANO ===";
$output[] = "";

// Check if any wisata contains "Tondano"
$wisatas = Wisata::where('name', 'like', '%Tondano%')->get();

if ($wisatas->count() > 0) {
    $output[] = "✓ Found {$wisatas->count()} wisata(s) matching 'Tondano':";
    foreach ($wisatas as $wisata) {
        $output[] = "  - ID: {$wisata->id}";
        $output[] = "    Name: {$wisata->name}";
        $output[] = "    Province: " . ($wisata->province ? $wisata->province->name : 'N/A');
        $output[] = "    Image: " . ($wisata->image ?: 'NULL');
        $output[] = "";
    }
} else {
    $output[] = "✗ NO wisata found matching 'Tondano'";
    $output[] = "";
}

// Write to file
$outputText = implode(PHP_EOL, $output);
file_put_contents(__DIR__ . '/tondano_check_result.txt', $outputText);

echo $outputText;

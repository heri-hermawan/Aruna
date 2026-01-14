<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check wisata with missing images
echo "=== Wisata dengan Gambar Kosong ===\n";
$wisatasWithoutImage = \App\Models\Wisata::whereNull('image')->orWhere('image', '')->get();
echo "Total: " . count($wisatasWithoutImage) . "\n";
foreach ($wisatasWithoutImage as $w) {
    echo "- ID: {$w->id}, Name: {$w->name}\n";
}

// Check kuliner with missing images
echo "\n=== Kuliner dengan Gambar Kosong ===\n";
$kulinerWithoutImage = \App\Models\Kuliner::whereNull('image')->orWhere('image', '')->get();
echo "Total: " . count($kulinerWithoutImage) . "\n";
foreach ($kulinerWithoutImage as $k) {
    echo "- ID: {$k->id}, Name: {$k->name}\n";
}

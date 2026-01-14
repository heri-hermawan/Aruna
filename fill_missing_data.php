<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Filling Missing Images and Rating Values ===\n\n";

// Use a default image for missing wisata images
$defaultWisataImage = 'images/wisata/default.jpg';
$defaultKulinerImage = 'images/kuliner/default.jpg';

// Fill missing wisata images
echo "1. Updating Wisata images...\n";
$wisatasWithoutImage = \App\Models\Wisata::whereNull('image')->orWhere('image', '')->get();
foreach ($wisatasWithoutImage as $wisata) {
    // Try to find a matching image or use default
    // For now, use name-based image if possible, or default
    $imageName = str_replace(' ', '_', strtolower($wisata->name));
    $wisata->image = "images/wisata/{$imageName}.jpg";
    $wisata->save();
}
echo "   Updated " . count($wisatasWithoutImage) . " wisata records\n";

// Fill missing kuliner images
echo "\n2. Updating Kuliner images...\n";
$kulinerWithoutImage = \App\Models\Kuliner::whereNull('image')->orWhere('image', '')->get();
foreach ($kulinerWithoutImage as $kuliner) {
    // For now, use name-based image if possible, or default
    $imageName = str_replace(' ', '_', strtolower($kuliner->name));
    $kuliner->image = "images/kuliner/{$imageName}.jpg";
    $kuliner->save();
}
echo "   Updated " . count($kulinerWithoutImage) . " kuliner records\n";

// Fill rating values with random data (1-10 scale)
echo "\n3. Updating Wisata rating values...\n";
$allWisatas = \App\Models\Wisata::get();
foreach ($allWisatas as $wisata) {
    if (is_null($wisata->daya_tarik) || $wisata->daya_tarik == 0) {
        $wisata->daya_tarik = rand(6, 10);
    }
    if (is_null($wisata->populer) || $wisata->populer == 0) {
        $wisata->populer = rand(4, 10);
    }
    if (is_null($wisata->harga) || $wisata->harga == 0) {
        $wisata->harga = rand(0, 500000);
    }
    if (is_null($wisata->fasilitas) || $wisata->fasilitas == 0) {
        $wisata->fasilitas = rand(5, 10);
    }
    if (is_null($wisata->kebersihan) || $wisata->kebersihan == 0) {
        $wisata->kebersihan = rand(5, 10);
    }
    $wisata->save();
}
echo "   Updated " . count($allWisatas) . " wisata rating values\n";

// Fill rating values for kuliner
echo "\n4. Updating Kuliner rating values...\n";
$allKuliners = \App\Models\Kuliner::get();
foreach ($allKuliners as $kuliner) {
    if (is_null($kuliner->rasa) || $kuliner->rasa == 0) {
        $kuliner->rasa = rand(7, 10);
    }
    if (is_null($kuliner->populer) || $kuliner->populer == 0) {
        $kuliner->populer = rand(4, 10);
    }
    if (is_null($kuliner->gizi) || $kuliner->gizi == 0) {
        $kuliner->gizi = rand(5, 10);
    }
    if (is_null($kuliner->biaya) || $kuliner->biaya == 0) {
        $kuliner->biaya = rand(5000, 500000);
    }
    if (is_null($kuliner->porsi) || $kuliner->porsi == 0) {
        $kuliner->porsi = rand(5, 10);
    }
    $kuliner->save();
}
echo "   Updated " . count($allKuliners) . " kuliner rating values\n";

echo "\n✓ All missing data has been filled!\n";

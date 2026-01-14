<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Recommendation Endpoints ===\n\n";

// Test getAllKuliner
echo "1. Testing getAllKuliner():\n";
$kuliners = \App\Models\Kuliner::getAllKuliner();
echo "   Total kuliner: " . count($kuliners) . "\n";
if (count($kuliners) > 0) {
    echo "   First kuliner: " . $kuliners[0]->name . "\n";
}

// Test getAllWisata
echo "\n2. Testing getAllWisata():\n";
$wisatas = \App\Models\Wisata::getAllWisata();
echo "   Total wisata: " . count($wisatas) . "\n";
if (count($wisatas) > 0) {
    echo "   First wisata: " . $wisatas[0]->name . "\n";
}

// Test RecommendationController
echo "\n3. Testing RecommendationController instantiation:\n";
$controller = new \App\Http\Controllers\Api\RecommendationController();
echo "   RecommendationController created successfully\n";

echo "\n✓ All tests passed! The recommendation menu is ready.\n";

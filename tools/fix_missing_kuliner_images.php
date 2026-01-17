<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kuliner;

echo "Fixing missing kuliner images...\n\n";

// Map of kuliner names to their correct image paths
$fixes = [
    'Pendap' => 'images/kuliner/Pendap_v2.jpg',
    'Bagar Hiu' => 'images/kuliner/Bagar_Hiu_v2.png',
];

foreach ($fixes as $name => $imagePath) {
    echo "Processing: {$name}\n";
    
    $kuliner = Kuliner::where('name', 'LIKE', "%{$name}%")->first();
    
    if ($kuliner) {
        echo "  Found ID: {$kuliner->id}\n";
        echo "  Current Image: {$kuliner->image}\n";
        
        $kuliner->image = $imagePath;
        $kuliner->save();
        
        echo "  Updated Image: {$imagePath}\n";
        echo "  ✓ Success!\n";
    } else {
        echo "  ✗ Not found in database\n";
    }
    
    echo "---\n";
}

echo "\nDone!\n";

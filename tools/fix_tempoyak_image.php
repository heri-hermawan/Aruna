<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kuliner;

echo "Checking for Tempoyak entries...\n";

// Find all Tempoyak entries
$kuliners = Kuliner::where('name', 'LIKE', '%Tempoyak%')->get();

echo "Found " . $kuliners->count() . " entries\n\n";

foreach ($kuliners as $kuliner) {
    echo "ID: {$kuliner->id}\n";
    echo "Name: {$kuliner->name}\n";
    echo "Current Image: {$kuliner->image}\n";
    
    // Update the image path to the correct one
    $newPath = 'images/kuliner/tempoyak.jpg';
    
    $kuliner->image = $newPath;
    $kuliner->save();
    
    echo "Updated Image: {$newPath}\n";
    echo "---\n";
}

echo "\nDone!\n";

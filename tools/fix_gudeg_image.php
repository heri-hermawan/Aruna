<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kuliner;

echo "Checking Gudeg entries...\n\n";

// Find Gudeg entries
$kuliners = Kuliner::where('name', 'LIKE', '%Gudeg%')->get();

echo "Found " . $kuliners->count() . " entries\n\n";

foreach ($kuliners as $kuliner) {
    echo "ID: {$kuliner->id}\n";
    echo "Name: {$kuliner->name}\n";
    echo "Current Image: " . ($kuliner->image ?? 'NULL') . "\n";
    
    // Update to correct path
    $newPath = 'images/kuliner/Gudeg.png';
    
    $kuliner->image = $newPath;
    $kuliner->save();
    
    echo "Updated Image: {$newPath}\n";
    echo "---\n";
}

echo "\nDone!\n";

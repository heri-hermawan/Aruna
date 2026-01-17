<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kuliner;

echo "Updating Popeda and Papeda images...\n\n";

// Update Popeda (Maluku Utara) - use Popeda_Malut.png
$popeda = Kuliner::where('name', 'Popeda')->first();
if ($popeda) {
    echo "Found Popeda:\n";
    echo "  ID: {$popeda->id}\n";
    echo "  Province: {$popeda->province->name}\n";
    echo "  Old Image: {$popeda->image}\n";
    
    $popeda->image = 'images/kuliner/Popeda_Malut.png';
    $popeda->save();
    
    echo "  New Image: {$popeda->image}\n";
    echo "  ✅ Updated!\n\n";
}

// Update Papeda (Papua) - use papeda_maluku_1767578249.png
$papeda = Kuliner::where('name', 'Papeda')->first();
if ($papeda) {
    echo "Found Papeda:\n";
    echo "  ID: {$papeda->id}\n";
    echo "  Province: {$papeda->province->name}\n";
    echo "  Old Image: {$papeda->image}\n";
    
    $papeda->image = 'images/kuliner/papeda_maluku_1767578249.png';
    $papeda->save();
    
    echo "  New Image: {$papeda->image}\n";
    echo "  ✅ Updated!\n\n";
}

echo "Done!\n";

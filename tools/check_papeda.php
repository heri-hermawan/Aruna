<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kuliner;

echo "Checking Popeda and Papeda entries...\n\n";

// Find both entries
$kuliners = Kuliner::whereIn('name', ['Popeda', 'Papeda'])->get();

echo "Found " . $kuliners->count() . " entries\n\n";

foreach ($kuliners as $kuliner) {
    echo "ID: {$kuliner->id}\n";
    echo "Name: {$kuliner->name}\n";
    echo "Province: {$kuliner->province->name}\n";
    echo "Current Image: " . ($kuliner->image ?? 'NULL') . "\n";
    echo "---\n";
}

echo "\nAvailable image files:\n";
echo "- papeda_maluku_1767578249.png\n";
echo "- Papeda.webp\n";
echo "- Popeda_Malut.png\n";

<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Wisata;

echo "Checking Pahawang Island...\n\n";

$pahawang = Wisata::where('nama', 'Pahawang Island')->first();

if ($pahawang) {
    echo "Found: {$pahawang->nama}\n";
    echo "Image Path in DB: {$pahawang->gambar}\n";
    
    $fullPath = public_path($pahawang->gambar);
    echo "Full Path: {$fullPath}\n";
    echo "File Exists: " . (file_exists($fullPath) ? "YES" : "NO") . "\n";
    
    if (!file_exists($fullPath)) {
        echo "\n❌ Image file NOT FOUND!\n";
        echo "Need to generate new image.\n";
    } else {
        echo "\n✅ Image file EXISTS!\n";
    }
} else {
    echo "Pahawang Island not found in database!\n";
}

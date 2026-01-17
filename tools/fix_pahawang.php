<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking and fixing Pahawang Island image...\n\n";

// Get the current record
$wisata = DB::table('wisatas')->where('nama', 'Pahawang Island')->first();

if ($wisata) {
    echo "Found: {$wisata->nama}\n";
    echo "Current path in DB: {$wisata->gambar}\n\n";
    
    // Check if the file exists with that path
    $currentPath = public_path($wisata->gambar);
    echo "Checking: {$currentPath}\n";
    echo "Exists: " . (file_exists($currentPath) ? "YES" : "NO") . "\n\n";
    
    if (!file_exists($currentPath)) {
        // Try with space
        $newPath = "images/wisata/Pahawang Island.jpg";
        $fullNewPath = public_path($newPath);
        
        echo "Trying alternative: {$fullNewPath}\n";
        echo "Exists: " . (file_exists($fullNewPath) ? "YES" : "NO") . "\n\n";
        
        if (file_exists($fullNewPath)) {
            // Update database
            DB::table('wisatas')
                ->where('nama', 'Pahawang Island')
                ->update(['gambar' => $newPath]);
            
            echo "✅ Updated database path to: {$newPath}\n";
        } else {
            echo "❌ File not found! Need to generate image.\n";
        }
    } else {
        echo "✅ Image already exists with correct path!\n";
    }
} else {
    echo "❌ Wisata 'Pahawang Island' not found in database!\n";
}

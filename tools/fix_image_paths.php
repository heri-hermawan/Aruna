<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Fixing Image Paths ===\n\n";

// Get all actual files
$kulinerFiles = scandir(__DIR__ . '/../public/images/kuliner');
$wisataFiles = scandir(__DIR__ . '/../public/images/wisata');
$tradisiFiles = scandir(__DIR__ . '/../public/images/tradisi');

// Remove . and ..
$kulinerFiles = array_diff($kulinerFiles, ['.', '..']);
$wisataFiles = array_diff($wisataFiles, ['.', '..']);
$tradisiFiles = array_diff($tradisiFiles, ['.', '..']);

// Helper function to find matching file
function findMatchingFile($name, $files) {
    $normalizedName = strtolower(str_replace([' ', '_', '-'], '', $name));
    
    foreach ($files as $file) {
        $normalizedFile = strtolower(str_replace([' ', '_', '-'], '', pathinfo($file, PATHINFO_FILENAME)));
        
        if ($normalizedName === $normalizedFile) {
            return $file;
        }
    }
    
    return null;
}

// Fix Kuliner
echo "Checking Kuliner images...\n";
$kuliners = DB::table('kuliners')->get();
$fixedKuliner = 0;

foreach ($kuliners as $kuliner) {
    if ($kuliner->image) {
        $currentPath = $kuliner->image;
        $currentFile = basename($currentPath);
        $fullPath = __DIR__ . '/../public/' . $currentPath;
        
        // Check if file exists
        if (!file_exists($fullPath)) {
            $newFile = findMatchingFile(pathinfo($currentFile, PATHINFO_FILENAME), $kulinerFiles);
            
            if ($newFile) {
                $newPath = 'images/kuliner/' . $newFile;
                DB::table('kuliners')->where('id', $kuliner->id)->update(['image' => $newPath]);
                echo "✓ Fixed: {$kuliner->name}\n";
                echo "  Old: {$currentPath}\n";
                echo "  New: {$newPath}\n\n";
                $fixedKuliner++;
            } else {
                echo "✗ Missing: {$kuliner->name} - {$currentPath}\n\n";
            }
        }
    }
}

// Fix Wisata
echo "\nChecking Wisata images...\n";
$wisatas = DB::table('wisatas')->get();
$fixedWisata = 0;

foreach ($wisatas as $wisata) {
    if ($wisata->image) {
        $currentPath = $wisata->image;
        $currentFile = basename($currentPath);
        $fullPath = __DIR__ . '/../public/' . $currentPath;
        
        // Check if file exists
        if (!file_exists($fullPath)) {
            $newFile = findMatchingFile(pathinfo($currentFile, PATHINFO_FILENAME), $wisataFiles);
            
            if ($newFile) {
                $newPath = 'images/wisata/' . $newFile;
                DB::table('wisatas')->where('id', $wisata->id)->update(['image' => $newPath]);
                echo "✓ Fixed: {$wisata->name}\n";
                echo "  Old: {$currentPath}\n";
                echo "  New: {$newPath}\n\n";
                $fixedWisata++;
            } else {
                echo "✗ Missing: {$wisata->name} - {$currentPath}\n\n";
            }
        }
    }
}

// Fix Tradisi
echo "\nChecking Tradisi images...\n";
$tradisis = DB::table('tradisis')->get();
$fixedTradisi = 0;

foreach ($tradisis as $tradisi) {
    if ($tradisi->image) {
        $currentPath = $tradisi->image;
        $currentFile = basename($currentPath);
        $fullPath = __DIR__ . '/../public/' . $currentPath;
        
        // Check if file exists
        if (!file_exists($fullPath)) {
            $newFile = findMatchingFile(pathinfo($currentFile, PATHINFO_FILENAME), $tradisiFiles);
            
            if ($newFile) {
                $newPath = 'images/tradisi/' . $newFile;
                DB::table('tradisis')->where('id', $tradisi->id)->update(['image' => $newPath]);
                echo "✓ Fixed: {$tradisi->name}\n";
                echo "  Old: {$currentPath}\n";
                echo "  New: {$newPath}\n\n";
                $fixedTradisi++;
            } else {
                echo "✗ Missing: {$tradisi->name} - {$currentPath}\n\n";
            }
        }
    }
}

echo "\n=== Summary ===\n";
echo "Kuliner fixed: {$fixedKuliner}\n";
echo "Wisata fixed: {$fixedWisata}\n";
echo "Tradisi fixed: {$fixedTradisi}\n";
echo "Total fixed: " . ($fixedKuliner + $fixedWisata + $fixedTradisi) . "\n";

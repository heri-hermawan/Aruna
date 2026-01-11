<?php
/**
 * ╔═══════════════════════════════════════════════════════════╗
 * ║            UTILITY TOOLKIT - All-in-One Script            ║
 * ╚═══════════════════════════════════════════════════════════╝
 * 
 * Consolidated utility script for common operations
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\{Province, Tradisi, Wisata, Kuliner, Peraturan};

// Main menu
echo "╔═══════════════════════════════════════════════════════════╗\n";
echo "║              WISATA NUSANTARA - UTILITIES                 ║\n";
echo "╚═══════════════════════════════════════════════════════════╝\n\n";

echo "Available commands:\n";
echo "  1. Check Database Status\n";
echo "  2. Verify All Images\n";
echo "  3. Export Data (for backup)\n";
echo "  4. Quick Stats\n";
echo "  0. Exit\n\n";

$choice = readline("Enter choice (0-4): ");

switch ($choice) {
    case '1':
        checkDatabaseStatus();
        break;
    case '2':
        verifyAllImages();
        break;
    case '3':
        exportData();
        break;
    case '4':
        quickStats();
        break;
    case '0':
        exit(0);
    default:
        echo "Invalid choice\n";
}

// ============================================================
// FUNCTIONS
// ============================================================

function checkDatabaseStatus() {
    echo "\n╔═══════════════════════════════════════════════════════════╗\n";
    echo "║                  DATABASE STATUS                          ║\n";
    echo "╚═══════════════════════════════════════════════════════════╝\n\n";
    
    $stats = [
        'Provinces' => Province::count(),
        'Tradisi' => Tradisi::count(),
        'Wisata' => Wisata::count(),
        'Kuliner' => Kuliner::count(),
        'Peraturan' => Peraturan::count(),
    ];
    
    foreach ($stats as $model => $count) {
        echo sprintf("%-15s: %3d items\n", $model, $count);
    }
    
    echo "\n";
}

function verifyAllImages() {
    echo "\n╔═══════════════════════════════════════════════════════════╗\n";
    echo "║                  IMAGE VERIFICATION                       ║\n";
    echo "╚═══════════════════════════════════════════════════════════╝\n\n";
    
    $categories = [
        'Provinces' => Province::class,
        'Tradisi' => Tradisi::class,
        'Wisata' => Wisata::class,
        'Kuliner' => Kuliner::class,
    ];
    
    foreach ($categories as $name => $model) {
        $total = $model::count();
        $withImages = $model::whereNotNull('image')
            ->where('image', '!=', '')
            ->where('image', 'NOT LIKE', 'emoji:%')
            ->count();
        $coverage = $total > 0 ? ($withImages / $total) * 100 : 0;
        
        echo sprintf("%-15s: %3d/%3d (%5.1f%%)\n", $name, $withImages, $total, $coverage);
    }
    
    echo "\n";
}

function exportData() {
    echo "\n╔═══════════════════════════════════════════════════════════╗\n";
    echo "║                    EXPORT DATA                            ║\n";
    echo "╚═══════════════════════════════════════════════════════════╝\n\n";
    
    $timestamp = date('Y-m-d_His');
    $exportDir = storage_path("exports/{$timestamp}");
    
    if (!file_exists($exportDir)) {
        mkdir($exportDir, 0755, true);
    }
    
    $models = [
        'provinces' => Province::with('tradisis', 'wisatas', 'kuliners', 'peraturans')->get(),
        'tradisi' => Tradisi::with('province')->get(),
        'wisata' => Wisata::with('province')->get(),
        'kuliner' => Kuliner::with('province')->get(),
        'peraturan' => Peraturan::with('province')->get(),
    ];
    
    foreach ($models as $name => $data) {
        $file = "{$exportDir}/{$name}.json";
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo "✅ Exported: {$name}.json\n";
    }
    
    echo "\nExport complete! Files saved to: {$exportDir}\n\n";
}

function quickStats() {
    echo "\n╔═══════════════════════════════════════════════════════════╗\n";
    echo "║                    QUICK STATS                            ║\n";
    echo "╚═══════════════════════════════════════════════════════════╝\n\n";
    
    // Database counts
    echo "DATABASE:\n";
    echo "  Total Provinces: " . Province::count() . "\n";
    echo "  Total Tradisi: " . Tradisi::count() . "\n";
    echo "  Total Wisata: " . Wisata::count() . "\n";
    echo "  Total Kuliner: " . Kuliner::count() . "\n";
    echo "  Total Peraturan: " . Peraturan::count() . "\n\n";
    
    // Image coverage
    echo "IMAGE COVERAGE:\n";
    $tradisiTotal = Tradisi::count();
    $tradisiWithImages = Tradisi::whereNotNull('image')
        ->where('image', '!=', '')
        ->where('image', 'NOT LIKE', 'emoji:%')
        ->count();
    echo "  Tradisi: {$tradisiWithImages}/{$tradisiTotal} (" . 
         round(($tradisiWithImages / $tradisiTotal) * 100, 1) . "%)\n";
    
    $wisataTotal = Wisata::count();
    $wisataWithImages = Wisata::whereNotNull('image')
        ->where('image', '!=', '')
        ->where('image', 'NOT LIKE', 'emoji:%')
        ->count();
    echo "  Wisata: {$wisataWithImages}/{$wisataTotal} (" . 
         round(($wisataWithImages / $wisataTotal) * 100, 1) . "%)\n\n";
}

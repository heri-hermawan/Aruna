<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$request = \Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

use App\Models\Wisata;
use App\Models\Kuliner;

echo "=== WISATA IMAGES ===\n";
$wisatas = Wisata::select('id', 'name', 'image')->where('image', '!=', null)->limit(10)->get();
echo "Wisata dengan image: " . count($wisatas) . "\n";
foreach($wisatas as $w) {
    echo "  - {$w->name}: {$w->image}\n";
}

echo "\n=== KULINER IMAGES ===\n";
$kuliners = Kuliner::select('id', 'name', 'image')->where('image', '!=', null)->limit(10)->get();
echo "Kuliner dengan image: " . count($kuliners) . "\n";
foreach($kuliners as $k) {
    echo "  - {$k->name}: {$k->image}\n";
}

echo "\n=== DIRECTORY CHECK ===\n";
$pubDir = __DIR__ . '/public/storage/images';
if (is_dir($pubDir)) {
    $files = array_diff(scandir($pubDir), array('.', '..'));
    echo "Files in public/storage/images: " . count($files) . "\n";
    foreach($files as $f) {
        echo "  - $f\n";
    }
} else {
    echo "Directory tidak ada: $pubDir\n";
}
?>

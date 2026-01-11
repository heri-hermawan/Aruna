<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CHECKING KAWAH IJEN ===\n\n";

$wisata = DB::table('wisata')->where('name', 'like', '%Kawah Ijen%')->first();

if ($wisata) {
    echo "Found: {$wisata->name}\n";
    echo "Province: {$wisata->province}\n";
    echo "Image: " . ($wisata->image ?: 'NULL') . "\n";
} else {
    echo "Not found!\n";
}

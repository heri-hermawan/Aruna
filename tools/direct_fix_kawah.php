<?php

// Simple, direct database update for Kawah Ijen
$host = '127.0.0.1';
$db = 'projek2';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Find Kawah Ijen
    $stmt = $pdo->query("SELECT id, name, image FROM wisatas WHERE name LIKE '%Kawah Ijen%' LIMIT 1");
    $wisata = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$wisata) {
        die("ERROR: Kawah Ijen not found!\n");
    }
    
    echo "Found: {$wisata['name']}\n";
    echo "Current image: " . ($wisata['image'] ?: 'NULL') . "\n\n";
    
    // Update image
    $imagePath = 'images/wisata/kawah_ijen_1767529778.png';
    $stmt = $pdo->prepare("UPDATE wisatas SET image = ? WHERE id = ?");
    $stmt->execute([$imagePath, $wisata['id']]);
    
    echo "✅ Updated to: $imagePath\n";
    
    // Verify
    $stmt = $pdo->prepare("SELECT image FROM wisatas WHERE id = ?");
    $stmt->execute([$wisata['id']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✅ Verified: {$result['image']}\n";
    
} catch (PDOException $e) {
    die("ERROR: " . $e->getMessage() . "\n");
}

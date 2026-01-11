<?php

// Fix Danau Rano province from Sulawesi Barat to Sulawesi Tengah
$host = '127.0.0.1';
$db = 'projek2';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Find Danau Rano
    $stmt = $pdo->query("SELECT w.id, w.name, w.province_id, p.name as province_name 
                         FROM wisatas w 
                         JOIN provinces p ON w.province_id = p.id 
                         WHERE w.name LIKE '%Danau Rano%' 
                         LIMIT 1");
    $wisata = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$wisata) {
        die("❌ ERROR: Danau Rano not found!\n");
    }
    
    echo "Found Wisata:\n";
    echo "  Name: {$wisata['name']}\n";
    echo "  Current Province: {$wisata['province_name']} (ID: {$wisata['province_id']})\n\n";
    
    // Find Sulawesi Tengah province ID
    $stmt = $pdo->query("SELECT id, name FROM provinces WHERE name LIKE '%Sulawesi Tengah%' LIMIT 1");
    $province = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$province) {
        die("❌ ERROR: Sulawesi Tengah province not found!\n");
    }
    
    echo "Target Province:\n";
    echo "  Name: {$province['name']} (ID: {$province['id']})\n\n";
    
    // Update province
    $stmt = $pdo->prepare("UPDATE wisatas SET province_id = ? WHERE id = ?");
    $stmt->execute([$province['id'], $wisata['id']]);
    
    echo "✅ Successfully updated!\n\n";
    
    // Verify
    $stmt = $pdo->query("SELECT w.name, p.name as province_name 
                         FROM wisatas w 
                         JOIN provinces p ON w.province_id = p.id 
                         WHERE w.id = {$wisata['id']}");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "Verified:\n";
    echo "  {$result['name']} → {$result['province_name']}\n";
    
} catch (PDOException $e) {
    die("ERROR: " . $e->getMessage() . "\n");
}

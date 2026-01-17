<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projek2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

// Try different variations of the name
$names = ['Lore Lindu', 'Taman Nasional Lore Lindu', 'TN Lore Lindu'];

foreach ($names as $name) {
    $sql = "SELECT name, image FROM wisatas WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchName = "%$name%";
    $stmt->bind_param("s", $searchName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $row = $result->fetch_assoc()) {
        echo "Found: {$row['name']}\n";
        echo "Path in DB: {$row['image']}\n";
        
        $fullPath = __DIR__ . '/../public/' . $row['image'];
        echo "Full Path: {$fullPath}\n";
        echo "Exists: " . (file_exists($fullPath) ? "YES" : "NO") . "\n";
        break;
    }
    $stmt->close();
}

$conn->close();

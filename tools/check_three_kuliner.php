<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projek2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

// Check the three problematic foods
$foods = ['Asam Pedas', 'Bolu Kemojo', 'Tempoyak'];

foreach ($foods as $food) {
    $sql = "SELECT name, image FROM kuliners WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $food);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $row = $result->fetch_assoc()) {
        echo "=== {$row['name']} ===\n";
        echo "Path in DB: {$row['image']}\n";
        
        $fullPath = __DIR__ . '/../public/' . $row['image'];
        echo "Full Path: {$fullPath}\n";
        echo "Exists: " . (file_exists($fullPath) ? "YES" : "NO") . "\n\n";
    } else {
        echo "=== $food ===\n";
        echo "NOT FOUND in database\n\n";
    }
    $stmt->close();
}

$conn->close();

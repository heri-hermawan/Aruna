<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projek2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

$sql = "SELECT name, image FROM wisatas WHERE name = 'Krakatau'";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo "Name: {$row['name']}\n";
    echo "Path in DB: {$row['image']}\n";
    
    $fullPath = __DIR__ . '/../public/' . $row['image'];
    echo "Full Path: {$fullPath}\n";
    echo "Exists: " . (file_exists($fullPath) ? "YES" : "NO") . "\n";
} else {
    echo "NOT_FOUND";
}

$conn->close();

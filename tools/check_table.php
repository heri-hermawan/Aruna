<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projek2";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "Checking table structure...\n\n";
    
    // Show columns
    $sql = "SHOW COLUMNS FROM wisatas";
    $result = $conn->query($sql);
    
    if ($result) {
        echo "Columns in wisatas table:\n";
        while ($row = $result->fetch_assoc()) {
            echo "  - {$row['Field']} ({$row['Type']})\n";
        }
    }
    
    echo "\n\nChecking Pahawang Island data...\n\n";
    
    // Get the record
    $sql = "SELECT * FROM wisatas WHERE nama = 'Pahawang Island' LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result && $row = $result->fetch_assoc()) {
        echo "Found record:\n";
        foreach ($row as $key => $value) {
            if ($key == 'deskripsi' || $key == 'sejarah') {
                echo "  $key: [long text]\n";
            } else {
                echo "  $key: $value\n";
            }
        }
    } else {
        echo "❌ Wisata 'Pahawang Island' not found!\n";
    }
    
    $conn->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

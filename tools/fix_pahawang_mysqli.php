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
    
    echo "Checking and fixing Pahawang Island image...\n\n";
    
    // Get the current record (using 'name' not 'nama')
    $sql = "SELECT name, image FROM wisatas WHERE name = 'Pahawang Island'";
    $result = $conn->query($sql);
    
    if ($result && $row = $result->fetch_assoc()) {
        echo "Found: {$row['name']}\n";
        echo "Current path in DB: {$row['image']}\n\n";
        
        // Check if the file exists with that path
        $currentPath = __DIR__ . '/../public/' . $row['image'];
        echo "Checking: {$currentPath}\n";
        echo "Exists: " . (file_exists($currentPath) ? "YES" : "NO") . "\n\n";
        
        if (!file_exists($currentPath)) {
            // Try with space
            $newPath = "images/wisata/Pahawang Island.jpg";
            $fullNewPath = __DIR__ . '/../public/' . $newPath;
            
            echo "Trying alternative: {$fullNewPath}\n";
            echo "Exists: " . (file_exists($fullNewPath) ? "YES" : "NO") . "\n\n";
            
            if (file_exists($fullNewPath)) {
                // Update database
                $updateSql = "UPDATE wisatas SET image = ? WHERE name = 'Pahawang Island'";
                $stmt = $conn->prepare($updateSql);
                $stmt->bind_param("s", $newPath);
                
                if ($stmt->execute()) {
                    echo "✅ Updated database path to: {$newPath}\n";
                } else {
                    echo "❌ Failed to update database!\n";
                }
                
                $stmt->close();
            } else {
                echo "❌ File not found! Need to generate image.\n";
            }
        } else {
            echo "✅ Image already exists with correct path!\n";
        }
    } else {
        echo "❌ Wisata 'Pahawang Island' not found in database!\n";
    }
    
    $conn->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

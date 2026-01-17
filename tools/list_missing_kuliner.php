<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projek2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

// Get all kuliners with missing images
$sql = "SELECT id, name, image FROM kuliners ORDER BY name";
$result = $conn->query($sql);

$issues = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fullPath = __DIR__ . '/../public/' . $row['image'];
        
        if (!file_exists($fullPath)) {
            $issues[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image']
            ];
        }
    }
}

echo "Found " . count($issues) . " kuliners with missing images:\n\n";

foreach ($issues as $issue) {
    echo "❌ {$issue['name']}\n";
    echo "   Path in DB: {$issue['image']}\n\n";
}

$conn->close();

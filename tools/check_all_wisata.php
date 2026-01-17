<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projek2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

echo "Checking ALL Wisata images for issues...\n\n";

$sql = "SELECT id, name, image FROM wisatas ORDER BY name";
$result = $conn->query($sql);

$issues = [];
$total = 0;

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $total++;
        $name = $row['name'];
        $image = $row['image'];
        
        $fullPath = __DIR__ . '/../public/' . $image;
        
        if (!file_exists($fullPath)) {
            $issues[] = [
                'id' => $row['id'],
                'name' => $name,
                'image' => $image
            ];
        }
    }
}

echo "Checked $total wisata destinations\n";
echo "Found " . count($issues) . " images with issues:\n\n";

foreach ($issues as $issue) {
    echo "❌ {$issue['name']}\n";
    echo "   ID: {$issue['id']}\n";
    echo "   Path in DB: {$issue['image']}\n\n";
}

$conn->close();

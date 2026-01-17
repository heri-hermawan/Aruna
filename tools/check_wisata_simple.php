<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aruna_travel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Checking all Wisata images with issues...\n\n";

$sql = "SELECT nama, gambar FROM wisatas ORDER BY nama";
$result = $conn->query($sql);

$issues = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nama = $row['nama'];
        $gambar = $row['gambar'];
        
        $fullPath = __DIR__ . '/../public/' . $gambar;
        
        if (!file_exists($fullPath)) {
            $issues[] = [
                'nama' => $nama,
                'gambar' => $gambar,
                'fullPath' => $fullPath
            ];
        }
    }
}

echo "Found " . count($issues) . " images with issues:\n\n";

foreach ($issues as $issue) {
    echo "❌ {$issue['nama']}\n";
    echo "   Path in DB: {$issue['gambar']}\n";
    echo "   Full Path: {$issue['fullPath']}\n";
    echo "   Exists: NO\n\n";
}

$conn->close();

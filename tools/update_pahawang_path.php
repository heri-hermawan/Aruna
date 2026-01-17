<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projek2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

$newPath = "images/wisata/pahawang_island.jpg";

$sql = "UPDATE wisatas SET image = ? WHERE name = 'Pahawang Island'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $newPath);

if ($stmt->execute()) {
    echo "SUCCESS: Updated to $newPath";
} else {
    echo "FAILED";
}

$stmt->close();
$conn->close();

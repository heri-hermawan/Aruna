<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projek2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

$sql = "SELECT name, image FROM wisatas WHERE name = 'Pahawang Island'";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo $row['image'];
} else {
    echo "NOT_FOUND";
}

$conn->close();

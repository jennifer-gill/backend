<?php
$servername = "localhost";   // or your DB host
$username = "root";          // DB username
$password = "abab5656";              // DB password
$dbname = "kyoto_trident";   // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode([
        "success" => false,
        "message" => "Database connection failed: " . $conn->connect_error
    ]));
}
?>

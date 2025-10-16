<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$conn = new mysqli("localhost", "root", "abab5656", "kyoto_trident");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "DB Connection Failed"]));
}

$result = $conn->query("SELECT * FROM sales_users ORDER BY last_updated DESC");
$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode(["success" => true, "data" => $users]);

$conn->close();
?>

<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');


$servername = "localhost";
$username = "root"; 
$password = "abab5656"; 
$dbname = "kyoto_trident";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "DB Connection Failed: " . $conn->connect_error]));
}


$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['name'], $data['email'], $data['latitude'], $data['longitude'])) {
    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);
    $latitude = $conn->real_escape_string($data['latitude']);
    $longitude = $conn->real_escape_string($data['longitude']);
    $phone = isset($data['phone']) ? $conn->real_escape_string($data['phone']) : '';

    // Insert or update existing record
    $sql = "INSERT INTO sales_users (name, email, phone, latitude, longitude)
            VALUES ('$name', '$email', '$phone', '$latitude', '$longitude')
            ON DUPLICATE KEY UPDATE
            latitude='$latitude', longitude='$longitude', last_updated=NOW()";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Location saved successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database Error: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid data received"]);
}

$conn->close();
?>

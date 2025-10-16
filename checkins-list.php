<?php
header("Content-Type: application/json");
include 'db.php';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

$sql = "SELECT c.id, u.name, c.client, c.latitude, c.longitude, c.type, c.check_in_time, c.check_out_time
        FROM sales_checkins c
        LEFT JOIN sales_users u ON u.id = c.user_id";

if ($user_id > 0) {
    $sql .= " WHERE c.user_id = $user_id";
}

$sql .= " ORDER BY c.check_in_time ASC";

$result = $conn->query($sql);
$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode(["status" => "success", "data" => $data]);
$conn->close();
?>

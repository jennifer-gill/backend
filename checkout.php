<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$user_id  = $data['user_id'] ?? null;
$client   = $data['client'] ?? null;
$latitude = $data['latitude'] ?? null;
$longitude= $data['longitude'] ?? null;

if (!$user_id || !$client || !$latitude || !$longitude) {
    echo json_encode(['status'=>'error','message'=>'Missing fields']);
    exit;
}

// Fetch user name
$res = $conn->query("SELECT name FROM sales_users WHERE id='$user_id'");
$user = $res->fetch_assoc();
$username = $user['name'] ?? 'Unknown';

$sql = "INSERT INTO sales_checkins (user_id, name, client, type, check_out_time, latitude, longitude) 
        VALUES ('$user_id','$username','$client','out',NOW(),'$latitude','$longitude')";

if ($conn->query($sql)) {
    echo json_encode(['status'=>'success','message'=>'Checked out']);
} else {
    echo json_encode(['status'=>'error','message'=>'DB error']);
}
?>

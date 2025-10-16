<?php
include 'db.php';

// Get latest location per user
$sql = "
  SELECT s1.*
  FROM sales_checkins s1
  INNER JOIN (
    SELECT user_id, MAX(created_at) AS max_time
    FROM sales_checkins
    GROUP BY user_id
  ) s2
  ON s1.user_id = s2.user_id AND s1.created_at = s2.max_time
  ORDER BY s1.created_at DESC
";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(["status" => "success", "data" => $data]);
$conn->close();
?>

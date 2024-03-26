<?php
session_start();

include 'config.php';

// Assuming you have a user_id in your session, adjust this according to your authentication logic
$user_id = 1;

$sql = "SELECT COUNT(*) AS itemCount FROM cart WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $itemCount = $row['itemCount'];
    echo json_encode(['itemCount' => $itemCount]);
} else {
    // No items in the cart
    echo json_encode(['itemCount' => 0]);
}
?>

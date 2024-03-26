<?php
// update_order_status.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a database connection established in your config.php file
    include 'config.php';

    // Get the order ID and new status from the AJAX request
    $orderId = $_POST['orderId'];
    $newStatus = $_POST['status'];

    // Update the order status in the database
    $updateQuery = "UPDATE orders SET status = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($updateQuery);
    $stmtUpdate->bind_param("si", $newStatus, $orderId);

    if ($stmtUpdate->execute()) {
        // If the update is successful, you can send a success response
        echo json_encode(['success' => true]);
    } else {
        // If there's an error, send an error response
        echo json_encode(['error' => 'Error updating order status']);
    }

    // Close the database connection
    $stmtUpdate->close();
    $conn->close();
} else {
    // If the request method is not POST, send an error response
    echo json_encode(['error' => 'Invalid request method']);
}
?>

<?php
include 'config.php';

// Check if orderId and status parameters are set
if (isset($_POST['orderId']) && isset($_POST['status'])) {
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];

    // Update the order status in the database
    $updateQuery = "UPDATE orders SET status = ? WHERE id = ?";
    $stmtUpdateStatus = $conn->prepare($updateQuery);
    $stmtUpdateStatus->bind_param('si', $status, $orderId);

    if ($stmtUpdateStatus->execute()) {
        // Update successful
        $response = ['success' => true];
    } else {
        // Update failed
        $response = ['success' => false, 'message' => 'Failed to update order status'];
    }

    // Close the database connection
    $stmtUpdateStatus->close();
    $conn->close();

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If orderId or status parameters are not set, return an error response
    $response = ['success' => false, 'message' => 'Invalid parameters'];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

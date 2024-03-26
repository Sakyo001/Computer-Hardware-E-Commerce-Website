<?php

// Your database connection code here
$username = "root";
$password = "";
$database = "vimin";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the order ID and status from the AJAX request
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];

    // Update the status in the database
    $updateSql = "UPDATE orders SET status = :status WHERE id = :orderId";
    $updateStatement = $pdo->prepare($updateSql);
    $updateStatement->bindParam(':status', $status);
    $updateStatement->bindParam(':orderId', $orderId);

    if ($updateStatement->execute()) {
        echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection error: ' . $e->getMessage()]);
} finally {
    unset($pdo);
}
?>

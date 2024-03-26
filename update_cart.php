<?php
// update_cart.php

// Assuming you have a database connection in your config.php file
include 'config.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID and updated quantity from the request
    $productId = $_POST['id'];
    $updatedQuantity = $_POST['quantity'];

    // Update the cart table in the database
    $updateSql = "UPDATE cart SET quantity = ? WHERE product_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ii", $updatedQuantity, $productId);

    if ($updateStmt->execute()) {
        // Successful update
        echo 'success';
    } else {
        // Failed update
        echo 'error';
    }

    $updateStmt->close();
    $conn->close();
} else {
    // If it's not a POST request, return an error
    echo 'error';
}
?>

<?php
include 'config.php';

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    $productDetails = getProductDetails($productId, $conn);

    if ($productDetails) {
        echo json_encode($productDetails);
    } else {
        echo 'Product details not found.';
    }
} else {
    echo 'Invalid request.';
}

$conn->close();
?>

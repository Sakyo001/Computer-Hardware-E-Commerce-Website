<?php
include 'config.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $productData = $result->fetch_assoc();
        echo json_encode($productData);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'Product ID not provided']);
}
?>

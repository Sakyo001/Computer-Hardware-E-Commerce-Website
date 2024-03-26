<?php
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];

    // Assuming you have a user_id in your session, adjust this according to your authentication logic
    $user_id = 1;

    // Check if the product is already in the cart
    $sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
 
        $row = $result->fetch_assoc();
        $newQuantity = $row['quantity'] + 1;
        $updateSql = "UPDATE cart SET quantity = $newQuantity WHERE user_id = $user_id AND product_id = $productId";
        $conn->query($updateSql);
    } else {
        
        $insertSql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $productId, 1)";
        $conn->query($insertSql);
    }

    $response = [
        'success' => true,
        'message' => 'Item added to cart successfully',
    ];
    echo json_encode($response);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>

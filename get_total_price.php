<?php
// get_total_price.php

session_start();
include 'config.php';

$response = array('success' => false);

// Calculate the total price
$totalPrice = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
    
    $response['success'] = true;
    $response['totalPrice'] = $totalPrice;
}

header('Content-Type: application/json');
echo json_encode($response);
?>

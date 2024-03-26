<?php
// Include your database connection or any necessary initialization here
include 'config.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Perform the deletion operation in your database
     $sql = "DELETE FROM products WHERE id = $productId";
     $result = $conn->query($sql);
$products = [];

    // Redirect back to the products page after deletion
    header("Location: products.php");
    exit();
} else {
    // Redirect to an error page or handle the error accordingly
    header("Location: error.php");
    exit();
}
?>

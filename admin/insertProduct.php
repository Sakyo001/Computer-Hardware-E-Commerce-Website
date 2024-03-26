<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $category = $_POST['category'];

    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["productImage"]["name"]);

    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO products (product_image, product_name, product_description, price, stocks, category) 
                VALUES ('$targetFile', '$productName', '$productDescription', '$price', '$stocks', '$category')";

        $result = $conn->query($sql);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'File upload failed.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Form not submitted.']);
}

$conn->close();
?>

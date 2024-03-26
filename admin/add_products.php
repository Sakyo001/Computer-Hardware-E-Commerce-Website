
<?php
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "vimin";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $productImage = $_FILES["productImage"]["name"];
    $productName = $_POST["product_name"];
    $productDescription = $_POST["product_description"];
    $price = $_POST["price"];
    $stocks = $_POST["stocks"];
    $category = $_POST["category"];

    // TODO: Perform any necessary validation on the data

    // Insert data into the products table
    $sql = "INSERT INTO products (product_image, product_name, product_description, price, stocks, category) 
            VALUES ('$productImage', '$productName', '$productDescription', $price, $stocks, '$category')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to products.php after successful insertion
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-dz6cJ4jcJlf89d8OWOOyoIsP0S8t9Im7xc1fv9p6q2Cq1ObkI1gI1a3eZKL0qgP6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-vk0w/6NH9DUr7sFCaEn7GGg6O6MzQ0FuMzJ9zg3cFQUpWTkC9a6bFAKE1EtoqU2U" crossorigin="anonymous"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<!-- ... existing HTML code ... -->
<!-- ... existing HTML code ... -->

<div class="container mt-4 text-center">
    <h2>Add Product</h2>
    <form method="POST" action="add_products.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="productImage" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" name="product_name" required>
        </div>
        <div class="mb-3">
            <label for="productDescription" class="form-label">Product Description</label>
            <input type="text" class="form-control" id="productDescription" name="product_description" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="stocks" class="form-label">Stocks</label>
            <input type="number" class="form-control" id="stocks" name="stocks" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="cables">Cables</option>
                <option value="rj-45">RJ-45</option>
                <option value="lan">LAN</option>
                <option value="tools">Tools</option>
                <option value="5-ports">5 Ports</option>
                <option value="8-ports">8 Ports</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>

   
</div>

<!-- ... remaining HTML code ... -->


</body>
</html>
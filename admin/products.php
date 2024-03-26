<?php
// Include your database connection file (config.php)
include '../config.php';

// Fetch data from the products table
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "No records found";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-dz6cJ4jcJlf89d8OWOOyoIsP0S8t9Im7xc1fv9p6q2Cq1ObkI1gI1a3eZKL0qgP6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-vk0w/6NH9DUr7sFCaEn7GGg6O6MzQ0FuMzJ9zg3cFQUpWTkC9a6bFAKE1EtoqU2U" crossorigin="anonymous"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <title>Admin Panel</title>
</head>
<body>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-light sidebar sidebar-light accordion" id="accordionSidebar navigationStyle">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon ">
                <img src="img/pic3.png" alt="" width="40px" height="40px">
            </div>
            <div class="sidebar-brand-text mx-3 text-dark">VIMIN</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="admin.php" 
                >
                <i class="fa-solid fa-house" style="color:#000000;"></i>
                <span class="text-dark">Dashboard</span>
            </a>
          
        </li>
    
        


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="products.php" 
                >
                <i class="fa-solid fa-cart-shopping" style="color:#000000;"></i>
                <span class="text-dark">Products</span>
            </a>
          
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="orders.php" 
                >
                <i class="fas fa-clipboard-list" style="color:#000000;"></i>
                <span class="text-dark">Orders</span>
            </a>
          
        </li>



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
</ul>
        

<div id="content-wrapper" class="d-flex flex-column">

<div class="col-xl-11 col-md-10 mb-2 mt-4">

    <h1 class="h3 mb-4 text-black-500 text-center">Products</h1>

    <!-- Add button at the top -->
    <div class="d-flex justify-content-end">
        <a href="add_products.php" class="btn btn-primary mb-3">Add Product</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stocks</th>
                <th>Category</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><img src="img/<?= $product['product_image'] ?>" alt="<?= $product['product_name'] ?>" width="50"></td>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['product_description'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['stocks'] ?></td>
                    <td><?= $product['category'] ?></td>
                    <td>
                        <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>



</body>
</html>
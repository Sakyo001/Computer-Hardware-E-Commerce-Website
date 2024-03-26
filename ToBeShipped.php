<?php
include 'config.php';

$selectedTab = isset($_GET['tab']) ? $_GET['tab'] : 'toShipped'; // Updated tab name
$joinTable = 'orders';

$query = "SELECT id, status, cart_data, created_at FROM $joinTable";
$stmtFetchData = $conn->prepare($query);
$stmtFetchData->execute();
$stmtFetchData->bind_result($orderId, $orderStatus, $cartData, $createdAt);

$totalPrice = 0;
$cartDataList = [];

while ($stmtFetchData->fetch()) {
    $decodedData = json_decode($cartData, true);

    if ($decodedData !== null) {
        foreach ($decodedData as $item) {
            $cartDataList[] = [
                'name' => $item['name'] ?? '',
                'image' => $item['image'] ?? '',
                'quantity' => $item['quantity'] ?? '',
                'price' => $item['price'] ?? '',
                'createdAt' => $createdAt,
                'orderStatus' => $orderStatus,
            ];

            $totalPrice += is_numeric($item['price']) ? $item['price'] : 0;
        }
    } else {
        // Handle the case where JSON decoding failed
    }
}

// Filter data based on the selected tab
$filteredCartDataList = array_filter($cartDataList, function ($item) use ($selectedTab) {
    // Display items with the status "To Shipped"
    return $item['orderStatus'] === 'To Be Shipped' && $selectedTab === 'toShipped';
    // Add similar conditions for other tabs if needed
});

$totalPriceFormatted = is_numeric($totalPrice) ? number_format($totalPrice, 2) : '0.00';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style8.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>Receipt</title>


    <script>
        const tabs = document.querySelectorAll('#myTabs .nav-item .nav-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                // Remove the 'active' class from all tabs
                tabs.forEach(t => t.classList.remove('active'));

                // Add the 'active' class to the clicked tab
                this.classList.add('active');
            });
        });
    </script>


</head>
<body>








<div class="sidebar">
    <img src="img/pic3.png" alt="" width="30px" height="30px">
    <a href="home.php" class="nav-item" data-tooltip="Home"><i class="fas fa-home"></i></a>
    <?php
    $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
    $row_count = mysqli_num_rows($select_rows);
    ?>
    <a href="cart.php" class="nav-item" data-tooltip="Shopping Cart">
    <i class="fas fa-shopping-cart"></i>
    <span id="cartIcon" class="cart-icon"><?php echo $row_count;?></span>
    </a>    
    <a href="myPurchases.php" class="nav-item" data-tooltip="My Purchases"><i class="fas fa-truck"></i></a>

    <a href="receipt.php" class="nav-item" data-tooltip="Receipt"><i class="fas fa-receipt"></i></a>
    <div class="logout-button">
        <a href="index.php" id="logoutLink"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</div>


<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="receipt-tabs">
                    <ul class="nav nav-tabs justify-content-between" id="myTabs">
                        <li class="nav-item">
                            <a class="nav-link" href="myPurchases.php">Place an Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ToBeShipped.php">To Be Shipped</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ToBeDelivered.php">To Be Delivered</a>
                        </li>
                        <!-- Add similar list items for other tabs -->
                    </ul>

                    <div class="cart-data">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                    <th>Order Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($filteredCartDataList as $item) : ?>
                                    <tr>
                                        <td><img src="img/<?= $item['image'] ?>" alt="Product Image" width="20px;" height="20px;"></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td>$<?= $item['price'] ?></td>
                                        <td><?= $item['createdAt'] ?></td>
                                        <td><?= $item['orderStatus'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        

<div id="logoutPopup" class="popup-container">
    <div class="popup-box">
        <h2>Logout Confirmation</h2>
        <p>Are you sure you want to log out?</p>
        <button id="confirmLogout" class="popup-button">Yes, Logout</button>
        <button id="cancelLogout" class="popup-button cancel">Cancel</button>
        <div id="logoutConfirmation" style="display: none;">Logout successful!</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Get the logout link and logout popup elements
    const logoutLink = document.getElementById("logoutLink");
    const logoutPopup = document.getElementById("logoutPopup");
    const confirmLogout = document.getElementById("confirmLogout");
    const cancelLogout = document.getElementById("cancelLogout");
    const logoutConfirmation = document.getElementById("logoutConfirmation");

    // Set the initial state
    logoutConfirmation.style.display = "none";

    // Show the logout popup when the logout link is clicked
    logoutLink.addEventListener("click", (e) => {
        e.preventDefault(); // Prevent the link from navigating
        logoutPopup.style.display = "flex";
    });

    // Hide the logout popup when the "Cancel" button is clicked
    cancelLogout.addEventListener("click", () => {
        logoutPopup.style.display = "none";
    });

    // Display confirmation message when the "Yes, Logout" button is clicked
    confirmLogout.addEventListener("click", () => {
        // Hide the popup box
        logoutPopup.style.display = "none";

        // Show the logout confirmation message
        logoutConfirmation.style.display = "block";

        // You may want to redirect or perform other actions here
        window.location.href = "index.php";
    });

    const tabs = document.querySelectorAll('#myTabs .nav-item .nav-link');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove the 'active' class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            
            // Add the 'active' class to the clicked tab
            this.classList.add('active');
        });
    });
</script>

</body>
</html>


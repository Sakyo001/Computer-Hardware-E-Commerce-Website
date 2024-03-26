<?php

include 'config.php';

// Example of checking user authentication in receipt.php



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>Receipt</title>
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



<h1 class="text-center mt-2">Purchase History</h1>

<div class="container">
        <?php
        session_start();

        $status = 'Received';

        // Fetch data from the database based on the $status
        $fetchDataQuery = "SELECT cart_data, created_at FROM orders WHERE status = ?";
        $stmtFetchData = $conn->prepare($fetchDataQuery);
        $stmtFetchData->bind_param("s", $status);
        $stmtFetchData->execute();
        $stmtFetchData->bind_result($cartData, $createdAt);

        // Initialize totalPrice variable
        $totalPrice = 0;

        // Display fetched data in a centered, borderless table
        echo '<table class="table table-bordered mx-auto">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Image</th>';
        echo '<th>Quantity</th>';
        echo '<th>Price</th>';
        echo '<th>Created At</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($stmtFetchData->fetch()) {
            $decodedData = json_decode($cartData, true);

            // Check if decoding was successful
            if ($decodedData !== null) {
                // Display your data here in table rows
                foreach ($decodedData as $item) {
                    echo '<tr>';
                    echo '<td>' . $item['name'] . '</td>';
                    echo '<td><img src="img/' . $item['image'] . '" alt="Product Image"></td>';
                    echo '<td>' . $item['quantity'] . '</td>';
                    echo '<td>$' . $item['price'] . '</td>';
                    echo '<td>' . $createdAt . '</td>';
                    echo '</tr>';
                    
                    // Sum up the prices
                    $totalPrice += $item['price'];
                    
                }
            } else {
                // Handle the case where JSON decoding failed
            }
        }

        echo '</tbody>';
        echo '</table>';

        // Display total price
        
        // echo '<p class="mt-3 text-center">Total Price: $' . $totalPrice . '</p>';

        $stmtFetchData->close();
        ?>
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
</script>

</body>
</html>


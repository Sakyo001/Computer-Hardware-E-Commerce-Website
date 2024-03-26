<?php

include 'config.php';

// Example of checking user authentication in receipt.php
if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value'
    WHERE id = '$update_id'");
    if($update_quantity_query){
        header('location:cart.php');
    }
}

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
    header('location: cart.php');   
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart`");
    header('location: cart.php');   

}

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
<h3 class="text-center mt-5 table-heading">Cart</h3>

<div class="container ml-5 mt-2">
    <div class="table-responsive">
        <table class="table table-bordered ml-5">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                $grand_total = 0;
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        ?>
                        <tr>
                            <td class="align-middle"><img src="img/<?php echo $fetch_cart['product_image']; ?>" alt="" style="max-width: 100px; height: auto;"></td>
                            <td class="align-middle"><?php echo $fetch_cart['product_name']; ?></td>
                            <td class="align-middle"><?php echo number_format($fetch_cart['price']); ?></td>
                            <td class="align-middle">
                                <form class="d-flex" action="" method="post">
                                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                                    <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                                    <input type="submit" value="Update" class="btn btn-primary" name="update_update_btn">
                                </form>
                            </td>
                            <td class="align-middle"><?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
                            <td class="align-middle"><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Remove</a></td>
                        </tr>
                        <?php
                             $sub_total = str_replace(',', '', $fetch_cart['price'] * $fetch_cart['quantity']);
        
                             // Check if $sub_total is numeric before adding it to $grand_total
                             if (is_numeric($sub_total)) {
                                 $grand_total += $sub_total;
                             } else {
                                 // Handle the case where $sub_total is not numeric (e.g., log or debug)
                                 // You can add a specific handling logic here based on your requirements
                             }                        
                    };
                };
                ?>


                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2" id="totalPrice">₱ <?php echo $grand_total; ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-end checkout-btn">
                        <a href="home.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
                        <a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="btn btn-danger"><i class="fas fa-trash"></i> Delete All</a>
                        <a href="checkout.php" class="btn btn-primary <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Checkout <i class="fas fa-arrow-right"></i></a>
                    </td>
                </tr>
            </tfoot>
        </table>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-dz6cJ4jcJlf89d8OWOOyoIsP0S8t9Im7xc1fv9p6q2Cq1ObkI1gI1a3eZKL0qgP6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-vk0w/6NH9DUr7sFCaEn7GGg6O6MzQ0FuMzJ9zg3cFQUpWTkC9a6bFAKE1EtoqU2U" crossorigin="anonymous"></script>

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


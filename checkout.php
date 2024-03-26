<?php
session_start();

include 'config.php';

// Check if the 'cart' session variable is set for the current user
// Check if the 'cart' session variable is set
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = [];
}


$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file upload
    $targetDir = "C:/xampp/htdocs/Ordering System/proofOfPayment/"; // Specify the directory where you want to store the images
    $targetFile = $targetDir . basename($_FILES["payment_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image or a fake image
    $check = getimagesize($_FILES["payment_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["payment_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["payment_image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["payment_image"]["name"])) . " has been uploaded.";

            // Retrieve user input
            $email = $_POST['email'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNumber = $_POST['contact_number'];
            $deliveryOption = $_POST['delivery_option'];
            $paymentMode = $_POST['payment_mode'];

            // Calculate the total amount directly from the cart table
            $sqlCartTotal = "SELECT SUM(price * quantity) as total FROM cart";
            $result = mysqli_query($conn, $sqlCartTotal);
            $row = mysqli_fetch_assoc($result);
            $grandTotal = $row['total'];

            // Fetch product details from the cart for insertion into orders
            $cartProducts = mysqli_query($conn, "SELECT product_name, product_image, price, quantity FROM cart");
            $productsData = [];
            while ($cartProduct = mysqli_fetch_assoc($cartProducts)) {
                $productsData[] = [
                    'name' => $cartProduct['product_name'],
                    'image' => $cartProduct['product_image'],
                    'price' => $cartProduct['price'],
                    'quantity' => $cartProduct['quantity']
                ];
            }

            // Convert products data to JSON for storage in the database
            $cartData = json_encode($productsData);

            // Insert the order details into the database
            $status = 'pending';
            $createdAt = date('Y-m-d H:i:s');

            $sql = "INSERT INTO orders (email, name, address, contact_number, delivery_option, payment_mode, total_amount, created_at, status, cart_data, product_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssdssss", $email, $name, $address, $contactNumber, $deliveryOption, $paymentMode, $grandTotal, $createdAt, $status, $cartData, $targetFile);
            $stmt->execute();
            $stmt->close();

            // Clear the cart after the successful order
            mysqli_query($conn, "DELETE FROM cart");

foreach ($productsData as $product) {
    $productName = $product['name'];
    $quantityBought = $product['quantity'];

    // Fetch current stock from the database
    $selectStockSql = "SELECT stocks FROM products WHERE product_name = ?";
    $selectStockStmt = $conn->prepare($selectStockSql);
    $selectStockStmt->bind_param("s", $productName);
    $selectStockStmt->execute();
    $selectStockStmt->bind_result($currentStock);
    
    // Store the result to clear the command out of sync error
    $selectStockStmt->store_result();

    if ($selectStockStmt->fetch()) {
        // Calculate the new stock quantity
        $newStock = $currentStock - $quantityBought;

        // Update the stocks in the products table
        $updateStockSql = "UPDATE products SET stocks = ? WHERE product_name = ?";
        $updateStockStmt = $conn->prepare($updateStockSql);
        $updateStockStmt->bind_param("is", $newStock, $productName);
        $updateStockStmt->execute();
        $updateStockStmt->close();
    }

    // Free the result set
    $selectStockStmt->free_result();
    $selectStockStmt->close();
}

header('Location: home.php');
            exit;
// ... (existing code)

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}



?>

<!-- Rest of your HTML code remains unchanged -->




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style6.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Checkout</title>
</head>

<body>

<div class="grid">
   
<div class="row">
    <div class="left-grid">
        <div class="img d-none d-md-block">
        <img src="img/ceo.png" alt="">

        </div>
        <h2>Payment Information</h2>
        <p>Please add your payment information to complete your <br> order and get
        your products as soon as possible.
</p>
    </div>        
        
</div>
            

    <div class="row">
<div class="container multistep-container">

<div class="header">
    <h4 class="my-4 text-center">Checkout</h4>
</div>

<form method="post" action="" enctype="multipart/form-data">
   
    <div class="multistep-step active" id="step1">
        <i class="fas fa-user"></i>
        <div class="mb-2">
            <label for="deliveryOption" class="mb-3">Personal Information</label>
            <p></p>
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control shorter-input" id="email" name="email" required>
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control shorter-input" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control shorter-input" id="address" name="address" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="contactNumber" class="form-label">Contact Number</label>
            <input type="tel" class="form-control shorter-input" id="contactNumber" name="contact_number" required>
        </div>

        <a href="cart.php" class="btn btn-primary"><i class="fas fa-arrow-left" ></i>Go back to cart</a>
        <button type="button" class="btn btn-primary btn-color" onclick="nextStep(2)">Next<i class="fas fa-arrow-right"></i></button>
    </div>

    <!-- Step 2: Shipping Options -->
    <div class="multistep-step" id="step2">
    <i class="fas fa-truck"></i>

        <div class="mb-2">
            <label for="deliveryOption" class="form-label">Delivery Option</label>
            <select class="form-select" id="deliveryOption" name="delivery_option" required>
                <option value="standard">Standard Delivery</option>
                <option value="express">Express Delivery</option>
            </select>
        </div>

        <button type="button" class="btn btn-secondary btn-color" onclick="prevStep(1)"><i class="fas fa-arrow-left"></i> Back to Personal Details</button>
        <button type="button" class="btn btn-primary btn-color" onclick="nextStep(3)"><i class="fas fa-arrow-right"></i> Continue to Payment</button>
    </div>


    <!-- Step 3: Payment Method -->
    <div class="multistep-step" id="step3">
    <i class="fas fa-credit-card"></i>

    <div class="mb-2">
        <label for="paymentMode" class="form-label">Scan to Pay</label>

        </div>

        <div class="mb-1">
            <label for="paymentMode" class="form-label">Mode of Payment</label>
            <select class="form-select" id="paymentMode" name="payment_mode" onchange="setContactNumber()" required>
                <option value="gcash">GCash</option>
                <option value="paymaya">PayMaya</option>
            </select>
        </div>

        <div class="mb-1">
        <label for="paymentImage" class="form-label">Proof of Payment</label>
        <input type="file" class="form-control" id="paymentImage" name="payment_image" accept="image/*" required>
        </div>

        <div class="mb-3">
            <img id="qrcode" src="img/cat5.png" alt="" width="100px" height="100px">   
        </div>


        <div class="mb-3" style="font-weight: bold; font-size: 18px;">
        <?php
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
        $grand_total = 0;

        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = str_replace(',', '', $fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
                ?>
                <?php
            }
            ?>
            <span class="grand-total">Total: ₱ <?= number_format($grand_total); ?></span>
            <?php
        } else {
            echo "<div class='display-order'> <span>Your cart is empty!</span> </div>";
        }
        ?>
    </div>



        <button type="button" class="btn btn-secondary btn-color" onclick="prevStep(2)"><i class="fas fa-arrow-left"></i> Back to Shipping</button>
        <button type="submit" class="btn btn-primary btn-color">Place Order</button>
    </div>
</form>
</div>

</div>
    
</div>



<script>
    function nextStep(step) {
        $('.multistep-step.active').removeClass('active');
        $(`#step${step}`).addClass('active');
        updateButtonStyles(step);
        updateStepIconStyles(step);
    }

    function prevStep(step) {
        $('.multistep-step.active').removeClass('active');
        $(`#step${step}`).addClass('active');
        updateButtonStyles(step);
        updateStepIconStyles(step);
    }



    function updateButtonStyles(step) {
        $('.btn').removeClass('btn-primary').addClass('btn-secondary');
        $(`#step${step} button`).removeClass('btn-secondary').addClass('btn-primary');
    }

    function updateStepIconStyles(step) {
        $('.step-icon i').css('border-color', 'transparent');
        $(`.step-icon i:nth-child(${step})`).css('border-color', '#007bff');
    }
    

    function setContactNumber() {
    const paymentMode = document.getElementById('paymentMode');

    // Set default value and update if necessary
    if (paymentMode.value === 'gcash') {
        document.getElementById('qrcode').src = 'img/cat5.png';
    } else if (paymentMode.value === 'paymaya') {
        document.getElementById('qrcode').src = 'img/lc.png';
    }
}

document.addEventListener("DOMContentLoaded", () => {
    // Listen for changes in session storage and update total amount accordingly
    window.addEventListener('storage', (event) => {
        if (event.key === 'cart') {
            updateTotalAmount();
        }
    });

    // Set the initial total amount from PHP
    let initialTotalAmount = parseFloat(document.getElementById('hiddenTotalAmount').value);
    const totalAmountElement = document.getElementById('totalPrice');
    if (totalAmountElement) {
        totalAmountElement.innerText = '₱ ' + initialTotalAmount.toFixed(2);
    }

    // Call the function to set the QR code and contact number based on the selected payment mode
    setContactNumber();

    // Set the initial total amount
    updateTotalAmount();
});

function updateSubtotal(productId) {
    const quantityInput = document.getElementById(`quantity_${productId}`);
    const quantity = parseInt(quantityInput.value);

    // Update the subtotal for the specific product in the HTML
    const priceElement = document.getElementById(`price_${productId}`);
    if (!priceElement) {
        console.error(`Price element not found for product ID ${productId}`);
        return;
    }
    const price = parseFloat(priceElement.innerText.replace('₱ ', ''));
    const subtotal = price * quantity;
    const subtotalElement = document.getElementById(`subtotal_${productId}`);
    if (subtotalElement) {
        subtotalElement.innerText = '₱ ' + subtotal.toFixed(2);
    } else {
        console.error(`Subtotal element not found for product ID ${productId}`);
    }

    // Update the total amount
    updateTotalAmount();
}


function updateTotalAmount() {
    const cartRows = document.querySelectorAll('.table tbody tr');
    let totalAmount = 0;

    cartRows.forEach((row) => {
        const priceElement = row.querySelector('td:nth-child(4) span');
        const quantityInput = row.querySelector('.quantity-input');
        const subtotalElement = row.querySelector('td:nth-child(7)');

        if (priceElement && quantityInput && subtotalElement) {
            const price = parseFloat(priceElement.innerText.replace('₱ ', ''));
            const quantity = parseInt(quantityInput.value);
            const subtotal = price * quantity;
            subtotalElement.innerText = '₱ ' + subtotal.toFixed(2);
            totalAmount += subtotal;
        }
    });

    // Update the total amount in the HTML
    const totalAmountElement = document.getElementById('totalPrice');
    if (totalAmountElement) {
        totalAmountElement.innerText = '₱ ' + totalAmount.toFixed(2);
    }
}





</script>



</body>

</html>
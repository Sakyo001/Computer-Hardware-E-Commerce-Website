<?php
function getCategoryImage($category)
{
    // Assuming your images are in a folder named "category_images"
    $imageName = strtolower($category) . ".png";

    // Check if the image file exists
    $imagePath = "img/category_images/" . $imageName;
    return file_exists($imagePath) ? $imagePath : "img/default_category_image.png";

}

include 'config.php';

// Start the session
session_start();

// Assume that the category is passed as a query parameter, e.g., ?category=cables
$category = isset($_GET['category']) ? urldecode($_GET['category']) : 'all';

// Fetch products from the database based on the selected category
$sql = "SELECT * FROM products";
if ($category !== 'all') {
    $sql .= " WHERE category = '$category'";
}

// Execute the query and fetch results
$result = $conn->query($sql);

// Fetch unique categories from the database
$categorySql = "SELECT DISTINCT category FROM products";
$categoryResult = $conn->query($categorySql);


// ... (previous code)

if(isset($_POST['add_to_cart'])){
    $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $quantity = 1;
    $price = $_POST['price'];

    // Use prepared statement to prevent SQL injection
    $select_cart = mysqli_prepare($conn, "SELECT * FROM `cart` WHERE product_name = ?");
    mysqli_stmt_bind_param($select_cart, "s", $product_name);
    mysqli_stmt_execute($select_cart);
    $result = mysqli_stmt_get_result($select_cart);

    if(mysqli_num_rows($result) > 0){
        $message[] = 'Product already added to cart';
    } else {
        // Use prepared statement to prevent SQL injection
        $insert_product = mysqli_prepare($conn, "INSERT INTO `cart`(product_image, product_name, quantity, price) VALUES(?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_product, "ssdd", $product_image, $product_name, $quantity, $price);
        mysqli_stmt_execute($insert_product);
    }
}

// ... (continue with the rest of your code)




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-dz6cJ4jcJlf89d8OWOOyoIsP0S8t9Im7xc1fv9p6q2Cq1ObkI1gI1a3eZKL0qgP6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-vk0w/6NH9DUr7sFCaEn7GGg6O6MzQ0FuMzJ9zg3cFQUpWTkC9a6bFAKE1EtoqU2U" crossorigin="anonymous"></script>
    <title>Home Page</title>
</head>

<body>



<div class="sidebar">
    <img src="img/pic3.png" alt="" width="30px" height="30px">
    <a href="#home" class="nav-item" data-tooltip="Home"><i class="fas fa-home"></i></a>
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
        <!-- Update the logout link to trigger the logout confirmation -->
        <a href="#" id="logoutLink"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</div>



<div class="container">
    <div class="grid">
        <div class="left-column">
            <p>Choose</p>
            <h3>Categories</h3>
            <div class="img">
                <a href="home.php?category=all">
                    <img src="img/rubberbots.png" alt="Cables">
                    <strong>All</strong>
                </a>
            </div>
            <div class="img">
                <a href="home.php?category=cables">
                    <img src="img/COMLINK.png" alt="RJ-45">
                    <strong>Cables</strong>
                </a>
            </div>
            <div class="img">
                <a href="home.php?category=rj-45">
                    <img src="img/rj45.png" alt="Cables">
                    <strong>RJ-45</strong>
                </a>
            </div>
            <div class="img">
                <a href="home.php?category=lan">
                    <img src="img/lantester.png" alt="RJ-45">
                    <strong>LAN</strong>
                </a>
            </div>
            <div class="img">
                <a href="home.php?category=tools">
                    <img src="img/ct-pt.png" alt="Cables">
                    <strong>Tools</strong>
                </a>
            </div>
            <div class="img">
                <a href="home.php?category=5-ports">
                    <img src="img/m-5port.png" alt="RJ-45">
                    <strong>5-Ports</strong>
                </a>
            </div>
            <div class="img">
                <a href="home.php?category=8-ports">
                    <img src="img/m-8port.png" alt="Cables">
                    <strong>8-Ports</strong>
                </a>
            </div>

           
<!-- Add similar blocks for other categories as needed -->

           
            <!-- Add more category entries as needed -->
        </div>
        <div class="right-column">
        <form action="home.php" method="post">
        <div class="search">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit" class="search-button" name="search_button">Search</button>
        </div>
        </form>

            <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
                $categoryFilter = isset($_GET['category']) ? $_GET['category'] : 'all';
                $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

                // SQL query to retrieve products based on category and search term
                $sql = "SELECT * FROM `products` 
                        WHERE product_name LIKE '%$searchTerm%'" . ($categoryFilter !== 'all' ? " AND category = '$categoryFilter'" : '');

                $select_products = mysqli_query($conn, $sql);

                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                        ?>
                        <form action="" method="post" class="col">
                            <div class="product">
                                <img src="img/<?php echo $fetch_product['product_image']; ?>" alt="">
                                <h6><?php echo $fetch_product['product_name']; ?></h6>
                                <p class="price">Price: ₱ <?php echo $fetch_product['price']; ?></p>
                                <p class="stocks">Stocks: <?php echo $fetch_product['stocks'] ?> </p>
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['product_image']; ?>">
                                <input type="hidden" name="stocks" value="<?php echo $fetch_product['stocks']; ?>">
                                <input type="submit" class="btn" value="add to cart" name="add_to_cart">
                            </div>
                        </form>
                        <?php
                    }
                } else {
                    echo "<div class='display-order'> <span>No products found!</span> </div>";
                }
                ?>

                
            </div>
        </div>
    </div>
</div>

  <div class="chat-head" onclick="toggleFAQ()">
        <img src="img/chatbot.png" alt="Chatbot Logo">
    </div>

    <div class="chat-container" id="faq-container">
        <div class="chat">
            <div class="chat-messages" id="chat-messages">
                <!-- Initial welcome message -->
                <div class="bot-message">
                    <span class="typing-indicator" id="typing-indicator"></span>
                </div>
            </div>
            <div class="user-input">
                <input type="text" id="user-input" placeholder="Type your question number...">
                <button onclick="sendMessage()">Send</button>
            </div>
            <button onclick="exitChat()">Exit</button>
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


<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to add this item to your cart?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="confirmAddToCart()">Add to Cart</button>
            </div>
        </div>
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



    function typeEffect(element, text, speed) {
        let i = 0;
        const interval = setInterval(function() {
            element.innerHTML += text.charAt(i);
            i++;
            if (i > text.length) {
                clearInterval(interval);
            }
        }, speed);
    }

    
    const typingSpeed = 50; // Typing speed in milliseconds
        let welcomeDisplayed = false;

        function toggleFAQ() {
            const faqContainer = document.getElementById('faq-container');
            faqContainer.style.display = (faqContainer.style.display === 'none' || faqContainer.style.display === '') ? 'block' : 'none';

            if (faqContainer.style.display === 'block' && !welcomeDisplayed) {
                displayWelcome();
            }
        }

        function simulateTyping(message, isUser) {
            const typingIndicator = document.getElementById('typing-indicator');
            typingIndicator.style.display = 'inline';

            const currentMessage = document.getElementById('chat-messages');
            currentMessage.innerHTML += `<div class="${isUser ? 'user-message' : 'bot-message'}">${message}</div>`;

            // Scroll to the bottom of the chat container to show the latest message
            currentMessage.scrollTop = currentMessage.scrollHeight;

            typingIndicator.style.display = 'none';
        }

        function displayWelcome() {
            welcomeDisplayed = true;
            simulateTyping("Select a question by entering a number");
            simulateTyping("1. The online ordering system typically supports digital wallet such as: Gcash for customer convenience.");
            simulateTyping("2. How user-friendly is the interface for customers");
            simulateTyping("3. How does the system handle returns and refunds for online orders?");
            simulateTyping("4. Can the online ordering system be integrated with a business's existing website or app?");
          

        }

        function exitChat() {
            const userMessages = document.querySelectorAll('.user-message');
            
            // Remove only the user's messages
            userMessages.forEach(message => {
                message.remove();
            });

            // Hide the chat container
            const faqContainer = document.getElementById('faq-container');
            faqContainer.style.display = 'none';
        }

        const questions = {
    "1": "The online ordering system typically supports digital wallets such as Gcash for customer convenience.",
    "2": "The system is designed with a user-friendly interface, ensuring ease of use for customers placing orders online.",
    "3": "The system typically provides a process for handling returns and refunds, ensuring a smooth and transparent procedure for both businesses and customers.",
    "4": "Yes, the online ordering system is designed to integrate seamlessly with a business's existing website or app, providing a cohesive and branded customer experience."
};

function handleQuestion(number) {
    const answer = questions[number];
    if (answer) {
        simulateTyping(answer);
    } else {
        simulateTyping("Sorry, I don't have an answer for that question.");
    }
}

function sendMessage() {
    const userInput = document.getElementById('user-input');
    const userMessage = userInput.value.trim();

    if (userMessage !== '') {
        // Check if the user entered a valid question number
        const questionNumber = parseInt(userMessage);
        if (!isNaN(questionNumber)) {
            handleQuestion(questionNumber);
        } else {
            simulateTyping("Please enter a valid question number.");
        }

        userInput.value = '';
    }
}

        // Display the welcome message initially
        displayWelcome();
</script>

<input type="hidden" id="productIdInput">


</body>
</html>
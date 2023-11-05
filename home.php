<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Home Page</title>
</head>
<body>
    
<div class="sidebar">
    <img src="img/pic3.png" alt="" width="30px" height="30px">
    <a href="#home"><i class="fas fa-home"></i></a>
    <a href="#shop"><i class="fas fa-shopping-cart"></i></a>
    <a href="#my-purchases"><i class="fas fa-receipt"></i></a>
    <div class="logout-button">
        <a href="index.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</div>

<div class="content">
    <div class="grid-container">
        <div class="top-column">
            <div class="top-column-title">
                <h1>VIMIN POS ordering and inventory <br>management system</h1>
            </div>
            <div class="top-column-icons">
                <div class="search-bar">
                    <div class="search-container">
                        <input type="text" placeholder="Search...">
                        <i class="fas fa-search"></i> <!-- Font Awesome search icon -->
                    </div>
                </div>
                <div class="mode-icons">
                    <i id="toggle-mode" class="fas fa-sun"></i> <!-- Light/Dark mode icon -->
                </div>
            </div>
        </div>
        <div class="bottom-columns">
            <div class="bottom-column">
            <div class="categories">
        <div class="category">
            <div class="category-header">
                <p class="p">Choose</p>
                <h5>CATEGORIES</h5>
            </div>
            
        </div>
        <div class="category">
            <a href="#" class="category-link">
                <div class="category-content">
                    <img src="img/cat5.jpg" alt="Cables" class="img-fluid category-img">
                    <p class="small">Cables</p>
                </div>
            </a>
        </div>
        <div class="category">
            <a href="#" class="category-link">
                <div class="category-content">
                    <img src="img/cat5.jpg" alt="Cables" class="img-fluid category-img">
                    <p class="small">RJ45</p>
                </div>
            </a>
        </div>
        <div class="category">
        <a href="#" class="category-link">
                <div class="category-content">
                    <img src="img/cat5.jpg" alt="Cables" class="img-fluid category-img">
                    <p class="small">LAN</p>
                </div>
            </a>
        </div>
        <div class="category">
        <a href="#" class="category-link">
                <div class="category-content">
                    <img src="img/cat5.jpg" alt="Cables" class="img-fluid category-img">
                    <p class="small">Tools</p>
                </div>
            </a>
        </div>
        <div class="category">
        <a href="#" class="category-link">
                <div class="category-content">
                    <img src="img/cat5.jpg" alt="Cables" class="img-fluid category-img">
                    <p class="small">5 Ports</p>
                </div>
            </a>
        </div>
        <div class="category">
        <a href="#" class="category-link">
                <div class="category-content">
                    <img src="img/cat5.jpg" alt="Cables" class="img-fluid category-img">
                    <p class="small">8 Ports</p>
                </div>
            </a>
        </div>
        <div class="category">
        <a href="#" class="category-link">
                <div class="category-content">
                    <img src="img/cat5.jpg" alt="Cables" class="img-fluid category-img">
                    <p class="small">More</p>
                </div>
            </a>
        </div>
    </div>
            </div>
            <div class="bottom-column" id="middle-column">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <img src="img/rj45.jpg" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">Product 1</h5>
                    <p class="card-text">Description of Product 1 goes here.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: $25.0</li>
                    <li class="list-group-item">Available Stock: 150</li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="addToCart('Product 1', 'Description of Product 1', '$25.0', 150, 'img/rj45.jpg')">Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <img src="img/cat5.jpg" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">Product 2</h5>
                    <p class="card-text">Description of Product 2 goes here.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: $25.0</li>
                    <li class="list-group-item">Available Stock: 150</li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="addToCart('Product 2', 'Description of Product 2', '$25.0', 150, 'img/cat5.jpg')">Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <img src="img/cat5.jpg" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">Product 2</h5>
                    <p class="card-text">Description of Product 2 goes here.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: $25.0</li>
                    <li class="list-group-item">Available Stock: 150</li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="addToCart('Product 2', 'Description of Product 2', '$25.0', 150, 'img/cat5.jpg')">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="bottom-column" id="right-column">
    <div id="cart-content">
        <h2>Your Cart</h2>
    </div>
    <div id="checkout-form">
        <button class="btn btn-success" onclick="checkoutCart()">Checkout</button>
        <p>Total Amount: <span id="total-amount">0</span></p>
    </div>
</div>



        </div>
    </div>
</div>


    <script src="index.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
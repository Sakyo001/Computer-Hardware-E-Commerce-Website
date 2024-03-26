<?php
    include 'config.php';
    session_start();

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style9.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Home</title>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-5 p-4" style="background-color: rgba(255, 255, 255, 0.7);">
    <a class="navbar-brand" href="#">
        <img src="img/pic3.png" alt="" width="50px" height="50px" style="transform: rotate(45deg);">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="#" data-bs-target="#carouselSection" data-bs-toggle="collapse" onclick="scrollToSection('carouselSection')">Home</a>
            <a class="nav-item nav-link" href="#" data-bs-target="#aboutUsSection" data-bs-toggle="collapse" onclick="scrollToSection('aboutUsSection')">About Us</a>
            <a class="nav-item nav-link" href="#" data-bs-target="#faqSection" data-bs-toggle="collapse" onclick="scrollToSection('faqSection')">FAQ</a>
        </div>
    </div>
    <a class="nav-item nav-link ml-auto" href="showcase.php">Login</a>
</nav>

<div id="carouselSection">
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/pic1.jpg" class="d-block w-100" style="max-height: 400px; object-fit: contain;" alt="...">
            <a href="#" class="btn btn-primary shop-now-button">Shop Now</a>
        </div>
        <div class="carousel-item">
            <img src="img/pic3.jpg" class="d-block w-100" style="max-height: 400px; object-fit: contain;" alt="...">
            <a href="#" class="btn btn-primary shop-now-button">Shop Now</a>
        </div>
        <div class="carousel-item">
            <img src="img/pic4.jpg" class="d-block w-100" style="max-height: 400px; object-fit: contain;" alt="...">
            <a href="#" class="btn btn-primary shop-now-button">Shop Now</a>
        </div>
    </div>
</div>
</div>



<div class="container mt-5 text-align-center">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="img/ct-pt.png" class="card-img-top" alt="Product 1" style="object-fit: cover;">
                
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="img/lc.png" class="card-img-top" alt="Product 2" style="object-fit: cover;">
               
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="img/rj45.png" class="card-img-top" alt="Product 3" style="object-fit: cover;">
               
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="img/nailclip.png" class="card-img-top" alt="Product 1">
                
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="img/m-router.png" class="card-img-top" alt="Product 1">
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="img/COMLINK2.png" class="card-img-top" alt="Product 1">
               
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="img/cat5.png" class="card-img-top" alt="Product 1">
               
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="img/COMLINK.png" class="card-img-top" alt="Product 1">
               
            </div>
        </div>
        <!-- Add more cards as needed -->
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <a href="index.php" class="btn btn-primary">See More</a>
        </div>
    </div>
</div>


<div id="faqSection">
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center">FAQ</h2>

            <div class="accordion" id="faqAccordion">
                <!-- FAQ Item 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                        What payment options are supported by the online ordering system?                        </button>
                    </h2>
                    <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                        The online ordering system typically supports digital wallet such as: Gcash for customer convenience.                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                        How user-friendly is the interface for customers?
                        </button>
                    </h2>
                    <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                        The system is designed with a user-friendly interface, ensuring ease of use for customers placing orders online.                        </div>
                    </div>
                </div>
                <!-- FAQ Item 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                        How does the system handle returns and refunds for online orders?                    </h2>
                    <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                        he system typically provides a process for handling returns and refunds, ensuring a smooth and transparent procedure for both businesses and customers.                    </div>
                </div>

                <!-- Add more FAQ items as needed -->

            </div>
        </div>
    </div>
</div>
</div>



<div id="aboutUsSection">
<div class="container about-us mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center">About Us</h2>
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at justo vel leo eleifend efficitur. Fusce euismod justo vel augue facilisis gravida. Nulla facilisi. Curabitur eu odio at tortor consectetur ultricies in a orci. Donec id semper enim. Integer eu justo vel sapien fermentum ullamcorper.</p>
            <!-- Add more content as needed -->
        </div>
    </div>
</div>
</div>




<footer class="contact-footer">
    <h2>Contact Us</h2>
    <ul class="contact-info">
        <li><i class="fab fa-facebook"></i>VIMIN Store</li>
        <li><i class="fab fa-instagram"></i>VIMIN Store</li>
        <li><i class="fas fa-phone"></i>09123456789</li>
        <li><i class="fab fa-youtube"></i>VIMIN Store</li>   
        <li><i class="fa fa-shopping-bag"></i>VIMIN Store</li>
        <li><i class="fa fa-map-marker"></i>VIMIN Store</li>
        <li><i class="fas fa-envelope"></i>viminstore@gmail.com</li>
    </ul>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-e3GGTQ1dodBYGgbZiD7F5fKI5qdb6G1S1hEoEoqOsQbBRl5d+zYFYNfPHbNRgyZy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-5E1r2x7ZvY8j1CxaSFAxFdLHb1qV81iWbQcclCEyJbLRl5qX6tU7b0PFMe6mB1hX" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-MgEblzA7bmZPlH6Wqe7jIKA+TjZ7sPTzwW3hZbY/zzlQT0sCAw3ZdkWA1JQI1ce6" crossorigin="anonymous"></script>

<script>
       function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }
</script>

</body>
</html>
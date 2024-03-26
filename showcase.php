<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Check if it's an admin
    $adminQuery = "SELECT id, username, password FROM admin WHERE username = ?";
    $stmtAdmin = $conn->prepare($adminQuery);

    if (!$stmtAdmin) {
        die("Error in admin query: " . $conn->error);
    }

    $stmtAdmin->bind_param("s", $inputUsername);
    $stmtAdmin->execute();
    $stmtAdmin->bind_result($adminId, $adminUsername, $adminPassword);

    if ($stmtAdmin->fetch() && $inputPassword === $adminPassword) {
        $_SESSION['id'] = $adminId;
        $_SESSION['username'] = $adminUsername;
        header("Location: admin/admin.php");
        exit();
    }

    $stmtAdmin->close();

    // Check if it's a regular user in the "users" table
    $userQuery = "SELECT id, username, password FROM users WHERE username = ?";
    $stmtUser = $conn->prepare($userQuery);

    if (!$stmtUser) {
        die("Error in user query: " . $conn->error);
    }

    $stmtUser->bind_param("s", $inputUsername);
    $stmtUser->execute();
    $stmtUser->bind_result($userId, $userUsername, $userHashedPassword);

    if ($stmtUser->fetch() && password_verify($inputPassword, $userHashedPassword)) {
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $userUsername;
        header("Location: home.php");
        exit();
    }

    $stmtUser->close();

    // If neither admin nor regular user was found with the given credentials, show an error
    echo '<div class="alert-box">Incorrect username or password. Please try again.</div>';
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    <title>ViMin Inventory and Point of Sale System</title>
</head>
<body>



        <div class="logo">
            <img src="img/pic3.png" width="100px" height="100px">
            <h2>VIMIN STORE</h2>
        </div>

        <div class="grid-container">
        <div class="content">
            <div class="headings">
                <h1>ALWAYS READY <br> TO MAKE YOUR LIFE BETTER</h1>
                <p>Every step of the way</p>
            </div>

            <div class="login-form">
                <h2 class="h1">LOG IN</h2>

              
                <form action="" method="post">
                    <p>Username</p>
                    <input type="text" id="username" name="username" placeholder="Username">

                    <p>Password</p>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <br><br>
                    <input type="submit" value="LOGIN">
                    <h3>Not registered yet? <a href="register.php">Register Now</a></h3>
                </form>
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
  
</body>
</html>


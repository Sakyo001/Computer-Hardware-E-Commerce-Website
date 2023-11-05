<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
    <link rel="stylesheet" href="style1.css">
    <title>Registration Page</title>
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
                    <div class="registration-form">
        
                        <h2 class="h1">Registration</h2>

                        
                            <form action="register.php" method="post">
                                <p>Username</p>
                                <input type="text" id="username" name="username" placeholder="Username">
                                

                                <p>Password:</p>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                            

                                <p>Contact Number:</p>
                                <input type="number" id="contactnumber" name="contactnumber" placeholder="Contact Number">
                            

                                <div class="form-inline">
                                    <div class="input-group">
                                        <p>Age:</p>
                                        <input type="number" id="age" name="age" placeholder="Age">
                                    </div>

                                    <div class="input-group">
                                        <p>Birthday:</p>
                                        <input type="text" id="birthday" name="birthday" placeholder="mm/dd/yy">
                                    </div>
                                </div>
                                
                                <div class="s-input">
                                <p>Sex:</p>
                                    <div class="s-input-group">          
                                        <input type="radio" id="male" name="gender" value="male">
                                        <label for="male">Male</label>
                                    </div>
                                
                                    <div class="s-input-group">
                                        <input type="radio" id="female" name="gender" value="female">
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                                
                                <p>Address:</p>
                                <input type="text" id="address" name="address" placeholder="Address" required>
                                

                                <p>Postal Code:</p>
                                <input type="number" id="postalcode" name="postalcode" placeholder="Postal Code" required>
                                

                                <input type="submit" value="Register">

                                <h3>Already have an account? <a href="index.php">Click here</a></h3>
                            </form>
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
    <script>
        function showPopup() {
            var popup = document.getElementById("successPopup");
            popup.style.display = "block";
        }

    </script>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost"; // Replace with your MySQL server name
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "vimin"; // Replace with your database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user registration data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contact_number'];

    // Hash the password (for security)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert user data into the "registration" table
    $sql = "INSERT INTO registration (username, password, email, contact_number) VALUES (?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ssss", $username, $hashedPassword, $email, $contactNumber);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful, show the popup
        echo '<script>showPopup();</script>';
        // Delay the redirection by 2 seconds (adjust the time as needed)
        echo '<script>setTimeout(function() { window.location.href = "index.php"; }, 2000);</script>';
        exit(); // Ensure that no further code is executed after the redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>

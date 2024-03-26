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
                                <input type="text" id="username" name="username" placeholder="Username" required>
                                

                                <p>Password:</p>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                            

                                <p>Contact Number:</p>
                                <input type="number" id="contactnumber" name="contactnumber" placeholder="Contact Number" required>
                            

                                <div class="form-inline">
                                    <div class="input-group">
                                        <p>Age:</p>
                                        <input type="number" id="age" name="age" placeholder="Age" required>
                                    </div>

                                    <div class="input-group">
                                        <p>Birthday:</p>
                                        <input type="text" id="birthday" name="birthday" placeholder="mm/dd/yy" required>
                                    </div>
                                </div>
                                
                                <div class="s-input">
                                <p>Sex:</p>
                                    <div class="s-input-group">          
                                        <input type="radio" id="male" name="gender" value="male" required>
                                        <label for="male">Male</label>
                                    </div>
                                
                                    <div class="s-input-group">
                                        <input type="radio" id="female" name="gender" value="female" required>
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                                
                                <p>Address:</p>
                                <input type="text" id="address" name="address" placeholder="Address" required>
                                

                                <p>Postal Code:</p>
                                <input type="number" id="postalcode" name="postalcode" placeholder="Postal Code" required>
                                

                                <input type="submit" value="Register">

                                <h3>Already have an account? <a href="showcase.php">Click here</a></h3>
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
// Establish a database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "vimin"; // Your database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"]; // Plain text password
    $contactnumber = $_POST["contactnumber"];
    $age = $_POST["age"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $postalcode = $_POST["postalcode"];

    // Check if the username already exists
    $check_query = "SELECT * FROM registration WHERE username = '$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo '<script>alert("Username already exists. Please choose a different username.");</script>';
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user data with the hashed password
        $insert_query = "INSERT INTO registration (username, password, contactnumber, age, birthday, gender, address, postalcode) 
        VALUES ('$username', '$hashedPassword', '$contactnumber', '$age', '$birthday', '$gender', '$address', '$postalcode')";

        if ($conn->query($insert_query) === TRUE) {
            echo '<script>alert("Registration successful! You have created an account."); window.location.href="index.php";</script>';
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>


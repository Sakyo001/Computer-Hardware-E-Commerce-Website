<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Admin Panel</title>
</head>
<body>
<h1>Admin Panel</h1>

  <!-- Link to trigger the logout popup -->
  <a href="index.php" id="logoutLink">Logout</a>

<!-- Logout Popup Container -->
<div id="logoutPopup" class="popup-container">
    <div class="popup-box">
        <h2>Logout Confirmation</h2>
        <p>Are you sure you want to log out?</p>
        <button id="confirmLogout" class="popup-button">Yes, Logout</button>
        <button id="cancelLogout" class="popup-button cancel">Cancel</button>
        <div id="logoutConfirmation" style="display: none;">Logout successful!</div>
    </div>
</div>

<!-- JavaScript to show/hide the logout popup and display confirmation message -->
<script>
    // Get the logout link and logout popup elements
    const logoutLink = document.getElementById("logoutLink");
    const logoutPopup = document.getElementById("logoutPopup");
    const confirmLogout = document.getElementById("confirmLogout");
    const cancelLogout = document.getElementById("cancelLogout");
    const logoutConfirmation = document.getElementById("logoutConfirmation");

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

        window.location.href = "index.php";
    });
</script>
</body>
</html>
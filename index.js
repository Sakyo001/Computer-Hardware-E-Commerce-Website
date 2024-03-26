

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

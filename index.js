// Function to toggle between dark and light modes
function toggleMode() {
    const bodyElement = document.body;
    const modeIcon = document.getElementById('toggle-mode');

    // Check if dark mode is enabled
    if (bodyElement.classList.contains('dark-mode')) {
        bodyElement.classList.remove('dark-mode');
        modeIcon.classList.remove('fa-moon');
        modeIcon.classList.add('fa-sun');
    } else {
        bodyElement.classList.add('dark-mode');
        modeIcon.classList.remove('fa-sun');
        modeIcon.classList.add('fa-moon');
    }
}

// Add a click event listener to the mode icon for toggling dark/light mode
document.getElementById('toggle-mode').addEventListener('click', toggleMode);

// Check the initial mode (e.g., from a user preference or stored setting)
// and apply dark mode if necessary
// Example: Uncomment the lines below if you have a stored setting

// const isDarkModeEnabled = /* get user preference */;
// if (isDarkModeEnabled) {
//     toggleMode();
// }


function addToCart(productName, description, price, availableStock, imageSrc) {
    // Create a new product card in the right column
    const rightColumn = document.getElementById('right-column');

    // Create a unique identifier for the item (you can use a more robust method)
    const itemId = `${productName}-${Date.now()}`;

    // Create an object to represent the item
    const item = {
        productName,
        description,
        price,
        availableStock,
        id: itemId,
        imageSrc, // Ensure that the image source is correctly passed
    };

    // Create the product card
    const productCard = createProductCard(item);

    // Append the product card to the right column
    rightColumn.appendChild(productCard);

    // Save the added item to localStorage
    saveCartItem(item);
}

function createProductCard(item) {
    // Create a new product card
    const productCard = document.createElement('div');
    productCard.className = 'card';
    productCard.id = item.id; // Set the id attribute for the product card

    // Create the product card content
    productCard.innerHTML = `
        <img src="${item.imageSrc}" class="card-img-top" alt="Product Image"> <!-- Correct image source -->
        <div class="card-body">
            <h5 class="card-title">${item.productName}</h5>
            <p class="card-text">${item.description}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Price: ${item.price}</li>
            <li class="list-group-item">Available Stock: ${item.availableStock}</li>
        </ul>
        <div class="card-body">
            <button class="btn btn-danger" onclick="deleteCartItem('${item.id}')">Delete</button>
        </div>
    `;

    return productCard;
}

// ... (the rest of your code remains the same)


function saveCartItem(item) {
    localStorage.setItem(item.id, JSON.stringify(item));
}

function loadCartItems() {
    const rightColumn = document.getElementById('right-column');

    // Loop through localStorage and load saved cart items
    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        const item = JSON.parse(localStorage.getItem(key));

        // Create a new product card and add it to the right column
        const productCard = createProductCard(item);
        rightColumn.appendChild(productCard);
    }
}

function deleteCartItem(itemId) {
    // Remove the item from localStorage
    localStorage.removeItem(itemId);


    const rightColumn = document.getElementById('right-column');
    const itemToRemove = document.getElementById(itemId);
    if (itemToRemove) {
        rightColumn.removeChild(itemToRemove);
    }
}

// Load saved cart items when the page loads
window.addEventListener('load', loadCartItems);



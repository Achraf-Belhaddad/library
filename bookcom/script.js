// Sample data for books with images
const books = [
    { id: 1, title: "Book 1", price: 10.99, image: "images/al.jpg" },
    { id: 2, title: "Book 2", price: 11, image: "images/Mystery.jpg" },
    { id: 3, title: "Book 3", price: 15.99, image: "images/horror.jpg" },
    { id: 3, title: "Book 4", price: 12.99, image: "images/Novels.jpg" },
    { id: 3, title: "Book 5", price: 14, image: "images/Selfimp.jpg" },
    { id: 3, title: "Book 6", price: 11, image: "images/Fantasy.jpg" }
];

const cart = [];

// Load books into the book list
function loadBooks() {
    const bookList = document.getElementById('book-list');
    books.forEach(book => {
        const bookItem = document.createElement('div');
        bookItem.className = 'book-item';
        bookItem.innerHTML = `
            <img src="${book.image}" alt="${book.title}">
            <h3 class="TXT-COLOR">${book.title}</h3>
            <p>Price: $${book.price}</p>
            <button onclick="addToCart(${book.id})">Add to Cart</button>
        `;
        bookList.appendChild(bookItem);
    });
}

// Add book to the cart
function addToCart(bookId) {
    const book = books.find(b => b.id === bookId);
    cart.push(book);
    updateCart();
}

// Update the cart display and calculate total price
function updateCart() {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';
    let totalPrice = 0;
    cart.forEach(item => {
        const cartItem = document.createElement('li');
        cartItem.innerText = `${item.title} - $${item.price}`;
        cartItems.appendChild(cartItem);
        totalPrice += item.price;
    });
    document.getElementById('total-price').innerText = totalPrice.toFixed(2);
}

// View Cart
function viewCart() {
    document.getElementById('cart').style.display = 'block';
}

// Close Cart
function closeCart() {
    document.getElementById('cart').style.display = 'none';
}

// Checkout function
function checkout() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
    } else {
        alert("Thank you for your purchase!");
        cart.length = 0;
        updateCart();
        closeCart();
    }
}

// Load books when the page loads
window.onload = loadBooks;



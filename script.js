// Get cart count from localStorage
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const count = Object.values(cart).reduce((sum, item) => sum + item.quantity, 0);
    const badge = document.getElementById('cartBadge');
    if (badge) {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'inline-block' : 'none';
    }
}

// Show toast notification
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <span class="toast-icon">${type === 'success' ? '✓' : '✕'}</span>
            <span class="toast-message">${message}</span>
        </div>
    `;

    container.appendChild(toast);

    // Trigger animation
    setTimeout(() => toast.classList.add('show'), 10);

    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Add to Cart Function - Modern Version
function addToCart(itemId, itemName, price) {
    // Create a simple quantity input using a modern modal-like approach
    const quantity = prompt("How many would you like to add?", "1");

    if (quantity === null) return; // User cancelled

    const qty = parseInt(quantity);
    if (isNaN(qty) || qty < 1) {
        showToast('Please enter a valid quantity', 'error');
        return;
    }

    // Store in localStorage for client-side cart
    const cart = JSON.parse(localStorage.getItem('cart')) || {};

    if (cart[itemId]) {
        cart[itemId].quantity += qty;
    } else {
        cart[itemId] = {
            item_id: itemId,
            item_name: itemName,
            price: parseFloat(price),
            quantity: qty
        };
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartBadge();

    // Show success notification
    showToast(`${itemName} (×${qty}) added to cart!`, 'success');

    // Also sync to server
    fetch('cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `item_id=${itemId}&item_name=${itemName}&price=${price}&quantity=${qty}`
    }).catch(err => console.log('Server sync:', err));
}

// Form Validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll('input, textarea');

    for (let input of inputs) {
        if (input.value.trim() === '') {
            showToast('Please fill in all fields', 'error');
            return false;
        }
    }
    return true;
}

// Email Validation
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Date Validation for Reservations
function validateReservationDate() {
    const selectedDate = new Date(document.getElementById('res_date').value);
    const today = new Date();

    if (selectedDate < today) {
        showToast('Please select a future date', 'error');
        return false;
    }
    return true;
}

// Dynamic Cart Update
function updateCartDisplay() {
    fetch('get_cart.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('cart-count').innerText = data.count;
        });
}

// Search Menu Items
function searchMenu() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        const itemName = item.querySelector('h3').textContent.toLowerCase();
        if (itemName.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

// Image Preview
function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Initialize cart badge on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartBadge();
});
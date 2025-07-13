let cart = [];

function showOrderSummary() {
    const cartBox = document.querySelector('.cart-box');
    cartBox.scrollIntoView({ behavior: 'smooth' });
}

function addToCart(item, price, category = "default") {
    let itemExists = false;

    for (let i = 0; i < cart.length; i++) {
        if (cart[i].name === item && cart[i].category === category) {
            cart[i].quantity++;
            itemExists = true;
            break;
        }
    }

    if (!itemExists) {
        cart.push({ name: item, price: price, quantity: 1, category: category });
    }

    updateCart();
    showOrderSummary(); 
}

function updateCart() {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    cartItems.innerHTML = ''; 

    let total = 0;

    cart.forEach(item => {
        const li = document.createElement('li');
        const subtotal = item.price * item.quantity;
        li.innerHTML = `${item.name} x${item.quantity} <span>₱${subtotal}</span>`;
        cartItems.appendChild(li);
        total += subtotal;
    });

    cartTotal.textContent = total;
}

document.addEventListener('DOMContentLoaded', function () {
    const checkoutBtn = document.getElementById('checkout-btn');
    const cancelBtn = document.getElementById('cancel-btn');

    checkoutBtn.addEventListener('click', function () {
        if (cart.length === 0) {
            alert('Your cart is empty!');
            return;
        }
        fetch('/handlers/checkout.handler.php', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'include',
            body: JSON.stringify({ cart }) 
        })
        .then(response => response.json()) 
        .then(result => {
            if (result.message) {
                alert(result.message);
                cart = [];
                updateCart();
            } else {
                alert('Checkout error: ' + (result.error || 'Unknown'));
            }        
        })
        .catch(err => {
            console.error('Checkout failed:', err);
            alert('Checkout failed. Try again.');
        });
    });

    cancelBtn.addEventListener('click', function () {
        if (confirm('Are you sure you want to cancel your order?')) {
            cart = [];
            updateCart();
        }
    });
});


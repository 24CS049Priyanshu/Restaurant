<?php
session_start();
include 'connect.php';
include 'header.php';

// Handle AJAX cart operations
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = intval($_POST['quantity']);
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if (isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$item_id] = array(
            'item_name' => $item_name,
            'price' => floatval($price),
            'quantity' => $quantity
        );
    }
    
    echo json_encode(['success' => true, 'message' => 'Item added to cart']);
    exit();
}

// Handle remove item
if (isset($_GET['remove'])) {
    $item_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$item_id])) {
        unset($_SESSION['cart'][$item_id]);
    }
    header("Location: cart.php");
    exit();
}

// Handle update quantity
if (isset($_POST['update_quantity'])) {
    $item_id = $_POST['update_quantity'];
    $quantity = intval($_POST['quantity']);
    
    if (isset($_SESSION['cart'][$item_id])) {
        if ($quantity > 0) {
            $_SESSION['cart'][$item_id]['quantity'] = $quantity;
        } else {
            unset($_SESSION['cart'][$item_id]);
        }
    }
    header("Location: cart.php");
    exit();
}

// Calculate totals
$subtotal = 0;
$tax_rate = 0.10; // 10% tax
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$tax = $subtotal * $tax_rate;
$total = $subtotal + $tax;
?>

<div class="cart-hero">
    <div class="container">
        <h1>🛒 Your Shopping Cart</h1>
        <p><?php echo count($cart_items); ?> item(s) in cart</p>
    </div>
</div>

<div class="container cart-container">
    <?php if (empty($cart_items)): ?>
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h2>Your cart is empty</h2>
            <p>Start adding items from our menu!</p>
            <a href="menu.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    <?php else: ?>
        <div class="cart-content">
            <div class="cart-items-section">
                <h2>Order Summary</h2>
                <div class="cart-items">
                    <?php foreach ($cart_items as $item_id => $item): ?>
                        <div class="cart-item">
                            <div class="item-info">
                                <h3><?php echo htmlspecialchars($item['item_name']); ?></h3>
                                <p class="item-price">Rs. <?php echo number_format($item['price'], 2); ?></p>
                            </div>
                            <div class="item-quantity">
                                <form method="POST" class="quantity-form">
                                    <input type="hidden" name="update_quantity" value="<?php echo $item_id; ?>">
                                    <button type="button" class="qty-btn" onclick="decreaseQty(this)">−</button>
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="qty-input" onchange="this.form.submit()">
                                    <button type="button" class="qty-btn" onclick="increaseQty(this)">+</button>
                                </form>
                            </div>
                            <div class="item-total">
                                <p class="total-price">Rs. <?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                            </div>
                            <a href="cart.php?remove=<?php echo $item_id; ?>" class="remove-btn">✕</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="cart-summary">
                <h2>Summary</h2>
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span class="amount">Rs. <?php echo number_format($subtotal, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Tax (10%):</span>
                    <span class="amount">Rs. <?php echo number_format($tax, 2); ?></span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-row total-row">
                    <span>Total:</span>
                    <span class="amount">Rs. <?php echo number_format($total, 2); ?></span>
                </div>
                
                <div class="cart-actions">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="checkout.php" class="btn btn-primary btn-block">Proceed to Checkout</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary btn-block">Login to Checkout</a>
                        <p class="auth-hint">Please login to place an order</p>
                    <?php endif; ?>
                    <a href="menu.php" class="btn btn-secondary btn-block">Continue Shopping</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
function increaseQty(btn) {
    const input = btn.nextElementSibling;
    input.value = parseInt(input.value) + 1;
}

function decreaseQty(btn) {
    const input = btn.nextElementSibling;
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>

<?php
include 'footer.php';
$conn->close();
?>
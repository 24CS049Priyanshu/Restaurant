<?php
session_start();
include 'connect.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $delivery_address = trim($_POST['delivery_address']);
    $phone = trim($_POST['phone']);
    $total_amount = 0;
    
    // Validation
    if (empty($delivery_address) || empty($phone)) {
        $error = "Please fill in all required fields";
    } else {
        // Calculate total with tax
        foreach ($_SESSION['cart'] as $item_id => $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }
        $tax = $total_amount * 0.10;
        $total_with_tax = $total_amount + $tax;
        
        // Insert order
        $sql = "INSERT INTO orders (user_id, total_amount, delivery_address, status) 
                VALUES (?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ids", $user_id, $total_with_tax, $delivery_address);
            if ($stmt->execute()) {
                $order_id = $conn->insert_id;
                
                // Insert order items
                $insert_success = true;
                foreach ($_SESSION['cart'] as $item_id => $item) {
                    $sql = "INSERT INTO order_items (order_id, item_id, quantity, price) 
                            VALUES (?, ?, ?, ?)";
                    $item_stmt = $conn->prepare($sql);
                    if ($item_stmt) {
                        $price = floatval($item['price']);
                        $qty = intval($item['quantity']);
                        $item_stmt->bind_param("iiii", $order_id, $item_id, $qty, $price);
                        if (!$item_stmt->execute()) {
                            $insert_success = false;
                        }
                        $item_stmt->close();
                    } else {
                        $insert_success = false;
                    }
                }
                
                if ($insert_success) {
                    unset($_SESSION['cart']);
                    header("Location: order_confirmation.php?order_id=" . $order_id);
                    exit();
                } else {
                    $error = "Error adding items to order. Please try again.";
                }
            } else {
                $error = "Error creating order: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }
    }
}

// Get user info
$user_sql = "SELECT * FROM users WHERE user_id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $_SESSION['user_id']);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();
$user_stmt->close();

// Calculate totals
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$tax = $subtotal * 0.10;
$total = $subtotal + $tax;
?>

<div class="checkout-hero">
    <div class="container">
        <h1>✓ Checkout</h1>
        <p>Complete your order</p>
    </div>
</div>

<div class="container checkout-container">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="checkout-content">
        <!-- Order Form -->
        <div class="checkout-form-section">
            <h2>Delivery Details</h2>
            <form method="POST" class="checkout-form">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['full_name']); ?>" disabled readonly>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled readonly>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>

                <div class="form-group">
                    <label for="delivery_address">Delivery Address *</label>
                    <textarea id="delivery_address" name="delivery_address" rows="3" placeholder="Enter your full delivery address" required></textarea>
                </div>

                <div class="checkout-buttons">
                    <button type="submit" class="btn btn-primary btn-large">Place Order</button>
                    <a href="cart.php" class="btn btn-secondary btn-large">Back to Cart</a>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="checkout-summary">
            <h2>Order Summary</h2>
            
            <div class="summary-items">
                <h3>Items:</h3>
                <?php foreach ($_SESSION['cart'] as $item_id => $item): ?>
                    <div class="summary-item">
                        <span><?php echo htmlspecialchars($item['item_name']); ?> ×<?php echo $item['quantity']; ?></span>
                        <span class="amount">Rs. <?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="summary-divider"></div>

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
                <span>Total Amount:</span>
                <span class="amount">Rs. <?php echo number_format($total, 2); ?></span>
            </div>

            <div class="payment-info">
                <p><strong>Payment Method:</strong> Cash on Delivery</p>
                <p class="small">Pay when your order arrives at your doorstep</p>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
$conn->close();
?>
<?php
session_start();
include 'connect.php';
include 'header.php';

if (!isset($_GET['order_id'])) {
    header("Location: menu.php");
    exit();
}

$order_id = intval($_GET['order_id']);
$sql = "SELECT * FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    header("Location: menu.php");
    exit();
}

// Get order items
$items_sql = "SELECT oi.*, mi.item_name FROM order_items oi 
              LEFT JOIN menu_items mi ON oi.item_id = mi.item_id 
              WHERE oi.order_id = ?";
$items_stmt = $conn->prepare($items_sql);
$items_stmt->bind_param("i", $order_id);
$items_stmt->execute();
$items_result = $items_stmt->get_result();
$items = array();
while ($item = $items_result->fetch_assoc()) {
    $items[] = $item;
}
?>

<div class="confirmation-hero">
    <div class="container">
        <h1>✅ Order Confirmed!</h1>
        <p>Thank you for your order</p>
    </div>
</div>

<div class="container confirmation-container">
    <div class="confirmation-card">
        <div class="success-icon">✓</div>
        <h2>Order Successfully Placed</h2>
        <p class="confirmation-message">Your order has been confirmed. We'll prepare it and deliver it to your address soon!</p>

        <div class="order-summary">
            <h3>Order Details</h3>
            
            <div class="order-row">
                <span class="label">Order ID:</span>
                <span class="value">#<?php echo str_pad($order['order_id'], 6, '0', STR_PAD_LEFT); ?></span>
            </div>

            <div class="order-row">
                <span class="label">Order Date:</span>
                <span class="value"><?php echo date('d M Y, g:i A', strtotime($order['order_date'] ?? 'now')); ?></span>
            </div>

            <div class="order-row">
                <span class="label">Status:</span>
                <span class="value status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span>
            </div>

            <div class="divider"></div>

            <h3>Items Ordered</h3>
            <?php foreach ($items as $item): ?>
                <div class="order-item">
                    <span><?php echo htmlspecialchars($item['item_name']); ?> ×<?php echo $item['quantity']; ?></span>
                    <span>Rs. <?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                </div>
            <?php endforeach; ?>

            <div class="divider"></div>

            <div class="order-row total-row">
                <span class="label">Total Amount:</span>
                <span class="value">Rs. <?php echo number_format($order['total_amount'], 2); ?></span>
            </div>

            <div class="delivery-address">
                <h3>Delivery Address</h3>
                <p><?php echo htmlspecialchars($order['delivery_address']); ?></p>
            </div>
        </div>

        <div class="confirmation-actions">
            <a href="menu.php" class="btn btn-primary">Continue Shopping</a>
            <a href="profile.php" class="btn btn-secondary">View My Orders</a>
        </div>
    </div>
</div>

<?php
include 'footer.php';
$conn->close();
?>
                <span><?php echo date('d M, Y H:i', strtotime($order['order_date'])); ?></span>
            </div>
            <div class="detail-item">
                <strong>Delivery Address:</strong>
                <span><?php echo $order['delivery_address']; ?></span>
            </div>
        </div>
        
        <a href="menu.php" class="btn">Order More</a>
        <a href="index.php" class="btn">Go to Home</a>
    </div>
</body>
</html>
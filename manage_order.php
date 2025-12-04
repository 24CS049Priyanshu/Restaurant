<?php
session_start();
include '../includes/connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Update order status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $conn->query("UPDATE orders SET status = '$status' WHERE order_id = $order_id");
}

// Get all orders
$result = $conn->query("SELECT o.*, u.full_name FROM orders o JOIN users u ON o.user_id = u.user_id ORDER BY o.order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #2c3e50;
            padding: 2rem 0;
            color: white;
        }
        .admin-sidebar a {
            display: block;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
        }
        .admin-sidebar a:hover {
            background: #34495e;
        }
        .admin-content {
            margin-left: 250px;
            padding: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        table th {
            background: #ecf0f1;
            padding: 1rem;
            text-align: left;
            font-weight: bold;
        }
        table td {
            padding: 1rem;
            border-bottom: 1px solid #ecf0f1;
        }
        select {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        button {
            padding: 0.5rem 1rem;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background: #229954;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h2 style="padding: 0 1.5rem; color: white;">Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_menu.php">Manage Menu</a>
        <a href="manage_orders.php">Manage Orders</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="logout.php" style="background: #e74c3c; margin-top: 2rem;">Logout</a>
    </div>

    <!-- Content -->
    <div class="admin-content">
        <h1>Manage Orders</h1>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($order = $result->fetch_assoc()): ?>
                <form method="POST" style="display: contents;">
                    <tr>
                        <td>#<?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['full_name']; ?></td>
                        <td>Rs. <?php echo $order['total_amount']; ?></td>
                        <td>
                            <select name="status">
                                <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="confirmed" <?php echo $order['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                <option value="preparing" <?php echo $order['status'] == 'preparing' ? 'selected' : ''; ?>>Preparing</option>
                                <option value="ready" <?php echo $order['status'] == 'ready' ? 'selected' : ''; ?>>Ready</option>
                                <option value="delivered" <?php echo $order['status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </td>
                        <td><?php echo date('d M, Y H:i', strtotime($order['order_date'])); ?></td>
                        <td>
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                            <button type="submit">Update</button>
                        </td>
                    </tr>
                </form>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
session_start();
include '../includes/connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Get statistics
$total_orders = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
$total_revenue = $conn->query("SELECT SUM(total_amount) as sum FROM orders")->fetch_assoc()['sum'];
$pending_orders = $conn->query("SELECT COUNT(*) as count FROM orders WHERE status='pending'")->fetch_assoc()['count'];
$total_users = $conn->query("SELECT COUNT(*) as count FROM users WHERE role='customer'")->fetch_assoc()['count'];

// Get recent orders
$recent_orders = $conn->query("SELECT o.*, u.full_name FROM orders o JOIN users u ON o.user_id = u.user_id ORDER BY o.order_date DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Restaurant</title>
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
            overflow-y: auto;
        }
        .admin-sidebar h2 {
            padding: 0 1.5rem;
            margin-bottom: 2rem;
            color: #ecf0f1;
        }
        .admin-sidebar ul {
            list-style: none;
        }
        .admin-sidebar li {
            margin: 0;
        }
        .admin-sidebar a {
            display: block;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: background 0.3s ease;
            border-left: 3px solid transparent;
        }
        .admin-sidebar a:hover {
            background: #34495e;
            border-left-color: #e74c3c;
        }
        .admin-content {
            margin-left: 250px;
            padding: 2rem;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            border-top: 4px solid #e74c3c;
        }
        .stat-number {
            font-size: 2.5rem;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .stat-label {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        .recent-orders {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .recent-orders h3 {
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th {
            background: #ecf0f1;
            padding: 1rem;
            text-align: left;
            font-weight: bold;
            color: #2c3e50;
            border-bottom: 2px solid #bdc3c7;
        }
        table td {
            padding: 1rem;
            border-bottom: 1px solid #ecf0f1;
        }
        table tr:hover {
            background: #f8f9fa;
        }
        .logout-btn {
            display: block;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
            background: #e74c3c;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 2rem;
            text-align: center;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <!-- Admin Sidebar -->
    <div class="admin-sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_menu.php">Manage Menu</a></li>
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <h1>Dashboard</h1>
        <p>Welcome, <?php echo $_SESSION['admin_username']; ?></p>
        
        <!-- Statistics -->
        <div class="dashboard-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_orders; ?></div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">Rs. <?php echo number_format($total_revenue, 2); ?></div>
                <div class="stat-label">Total Revenue</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $pending_orders; ?></div>
                <div class="stat-label">Pending Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_users; ?></div>
                <div class="stat-label">Total Customers</div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="recent-orders">
            <h3>Recent Orders</h3>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($order = $recent_orders->fetch_assoc()): ?>
                    <tr>
                        <td>#<?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['full_name']; ?></td>
                        <td>Rs. <?php echo $order['total_amount']; ?></td>
                        <td><?php echo ucfirst($order['status']); ?></td>
                        <td><?php echo date('d M, Y', strtotime($order['order_date'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
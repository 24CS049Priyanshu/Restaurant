<?php
session_start();
include '../includes/connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Delete user
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE user_id = $user_id");
    header("Location: manage_users.php");
    exit();
}

// Get all customers
$result = $conn->query("SELECT * FROM users WHERE role = 'customer'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin</title>
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
        .delete-btn {
            padding: 0.5rem 1rem;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 3px;
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
        <h1>Manage Customers</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo date('d M, Y', strtotime($user['created_at'])); ?></td>
                    <td>
                        <a href="manage_users.php?delete=<?php echo $user['user_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
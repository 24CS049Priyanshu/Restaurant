<?php
session_start();
include '../includes/connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Delete menu item
if (isset($_GET['delete'])) {
    $item_id = $_GET['delete'];
    $conn->query("DELETE FROM menu_items WHERE item_id = $item_id");
    header("Location: manage_menu.php");
    exit();
}

// Get all menu items
$result = $conn->query("SELECT * FROM menu_items");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu - Admin</title>
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
        .add-menu-btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 2rem;
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
        .action-btns {
            display: flex;
            gap: 0.5rem;
        }
        .action-btns a {
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 3px;
            font-size: 0.9rem;
        }
        .edit-btn {
            background: #3498db;
            color: white;
        }
        .delete-btn {
            background: #e74c3c;
            color: white;
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
        <h1>Manage Menu Items</h1>
        <a href="add_menu.php" class="add-menu-btn">+ Add New Item</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($item = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $item['item_id']; ?></td>
                    <td><?php echo $item['item_name']; ?></td>
                    <td><?php echo $item['category']; ?></td>
                    <td>Rs. <?php echo $item['price']; ?></td>
                    <td><?php echo $item['availability'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <div class="action-btns">
                            <a href="edit_menu.php?id=<?php echo $item['item_id']; ?>" class="edit-btn">Edit</a>
                            <a href="manage_menu.php?delete=<?php echo $item['item_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .profile-item {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        .profile-label {
            font-weight: bold;
            color: #2c3e50;
        }
        .profile-value {
            color: #555;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">🍽️ Restaurant</h1>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="profile-container">
        <h2>My Profile</h2>
        
        <div class="profile-item">
            <div class="profile-label">Username</div>
            <div class="profile-value"><?php echo $user['username']; ?></div>
        </div>
        
        <div class="profile-item">
            <div class="profile-label">Full Name</div>
            <div class="profile-value"><?php echo $user['full_name']; ?></div>
        </div>
        
        <div class="profile-item">
            <div class="profile-label">Email</div>
            <div class="profile-value"><?php echo $user['email']; ?></div>
        </div>
        
        <div class="profile-item">
            <div class="profile-label">Phone</div>
            <div class="profile-value"><?php echo $user['phone'] ?? 'Not provided'; ?></div>
        </div>
        
        <div class="profile-item">
            <div class="profile-label">Address</div>
            <div class="profile-value"><?php echo $user['address'] ?? 'Not provided'; ?></div>
        </div>
        
        <div class="profile-item">
            <div class="profile-label">Member Since</div>
            <div class="profile-value"><?php echo date('d M, Y', strtotime($user['created_at'])); ?></div>
        </div>
    </div>
</body>
</html>
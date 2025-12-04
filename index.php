<?php
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">🍽️ Restaurant</h1>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="reservations.php">Reserve Table</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Our Restaurant</h1>
            <p>Experience authentic cuisine with the finest ingredients</p>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="register.php" class="btn btn-primary">Get Started</a>
            <?php else: ?>
                <a href="menu.php" class="btn btn-primary">Browse Menu</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="feature-box">
                <h3>🚗 Fast Delivery</h3>
                <p>Get your food delivered within 30 minutes</p>
            </div>
            <div class="feature-box">
                <h3>📱 Easy Ordering</h3>
                <p>Simple and quick online ordering system</p>
            </div>
            <div class="feature-box">
                <h3>🪑 Table Reservation</h3>
                <p>Reserve your table in advance</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Restaurant. All rights reserved.</p>
    </footer>

    <style>
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 20px;
            text-align: center;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease;
        }
        .btn-primary {
            background: #27ae60;
            color: white;
        }
        .btn-primary:hover {
            transform: scale(1.05);
        }
        .features {
            padding: 50px 20px;
            background: #f8f9fa;
        }
        .features .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        .feature-box {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .feature-box h3 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
        }
    </style>
</body>
</html>
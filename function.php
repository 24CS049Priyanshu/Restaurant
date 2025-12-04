<?php

// Check if user is logged in
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Sanitize input
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Format currency
function formatCurrency($amount) {
    return "Rs. " . number_format($amount, 2);
}

// Get user info
function getUserInfo($user_id, $conn) {
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Get menu items
function getMenuItems($conn, $category = null) {
    if ($category) {
        $sql = "SELECT * FROM menu_items WHERE category = ? AND availability = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
    } else {
        $sql = "SELECT * FROM menu_items WHERE availability = 1";
        $stmt = $conn->prepare($sql);
    }
    $stmt->execute();
    return $stmt->get_result();
}

// Get order details
function getOrderDetails($order_id, $conn) {
    $sql = "SELECT o.*, u.full_name, u.email FROM orders o 
            JOIN users u ON o.user_id = u.user_id WHERE o.order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Get order items
function getOrderItems($order_id, $conn) {
    $sql = "SELECT oi.*, m.item_name FROM order_items oi 
            JOIN menu_items m ON oi.item_id = m.item_id WHERE oi.order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    return $stmt->get_result();
}

?>
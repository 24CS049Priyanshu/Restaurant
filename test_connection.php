<?php
echo "<h2>Database Connection Test</h2>";
include 'connect.php';

if ($conn->connect_error) {
    echo "<div style='color: red; padding: 1rem; background: #f8d7da;'>";
    echo "<strong>Connection Failed:</strong> " . $conn->connect_error;
    echo "</div>";
} else {
    echo "<div style='color: green; padding: 1rem; background: #d4edda;'>";
    echo "<strong>✓ Database Connected Successfully!</strong><br>";
    echo "Server: " . $conn->server_info . "<br>";
    echo "Database: restaurant_db";
    echo "</div>";
}

$conn->close();
?>

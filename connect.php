<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurant_db";

// Try with socket first, if that fails try TCP
$conn = @new mysqli($servername, $username, $password, $database);

// If connection fails, try with explicit socket path
if ($conn->connect_error) {
    $socket = "/tmp/mysql.sock"; // Try Unix socket
    if (!file_exists($socket)) {
        // If Unix socket doesn't exist, try with host and port
        $conn = new mysqli("127.0.0.1", $username, $password, $database, 3306);
    } else {
        $conn = new mysqli("localhost", $username, $password, $database, null, $socket);
    }
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
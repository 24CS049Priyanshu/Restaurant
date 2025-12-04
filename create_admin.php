<?php
// create_admin.php
// Simple helper to create an admin user. Run from browser, then delete this file.

include 'connect.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $full_name = trim($_POST['full_name'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $message = 'Username, email and password are required.';
    } else {
        // check if username or email already exists
        $sql = "SELECT user_id FROM users WHERE username = ? OR email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows > 0) {
            $message = 'A user with this username or email already exists.';
        } else {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (username, email, password, full_name, role, created_at) VALUES (?, ?, ?, ?, 'admin', NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss', $username, $email, $hashed, $full_name);
            if ($stmt->execute()) {
                $message = 'Admin user created successfully. Username: ' . htmlspecialchars($username);
            } else {
                $message = 'DB insert failed: ' . $conn->error;
            }
        }
        if ($stmt) $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin - Helper</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: Arial, sans-serif; background:#f6f8fa; }
        .box { max-width:480px; margin:60px auto; background:white; padding:20px; border-radius:8px; box-shadow:0 4px 18px rgba(0,0,0,0.08); }
        label { display:block; margin-top:10px; font-weight:600; }
        input { width:100%; padding:10px; margin-top:6px; border:1px solid #ddd; border-radius:6px; }
        button { margin-top:16px; padding:10px 14px; background:#27ae60; color:white; border:none; border-radius:6px; cursor:pointer; }
        .note { margin-top:12px; font-size:0.95em; color:#555; }
        .error { background:#fde2e2; color:#9b1c1c; padding:10px; border-radius:6px; }
        .success { background:#e6ffef; color:#10421a; padding:10px; border-radius:6px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Create Admin User</h2>
        <p class="note">This helper will create an admin account in the <code>users</code> table. Delete this file after use.</p>

        <?php if ($message): ?>
            <div class="<?php echo (strpos($message, 'success') !== false || strpos($message, 'created') !== false) ? 'success' : 'error'; ?>"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="username">Username</label>
            <input id="username" name="username" required placeholder="admin">

            <label for="email">Email</label>
            <input id="email" name="email" type="email" required placeholder="admin@example.com">

            <label for="full_name">Full name (optional)</label>
            <input id="full_name" name="full_name" placeholder="Administrator">

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required placeholder="StrongPassword123">

            <button type="submit">Create Admin</button>
        </form>

        <p class="note">After creating the admin account, remove this file for security: <code>create_admin.php</code></p>
    </div>
</body>
</html>

<?php
session_start();
include 'connect.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $res_date = $_POST['reservation_date'] ?? '';
    $res_time = $_POST['reservation_time'] ?? '';
    $guests = $_POST['number_of_guests'] ?? '';
    $special_requests = $_POST['special_requests'] ?? '';
    
    // Validate inputs
    if (empty($res_date) || empty($res_time) || empty($guests)) {
        $error = "Please fill in all required fields";
    } else {
        $sql = "INSERT INTO reservations (user_id, reservation_date, reservation_time, 
                number_of_guests, special_requests) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("issis", $user_id, $res_date, $res_time, $guests, $special_requests);
            
            if ($stmt->execute()) {
                $success = "✅ Reservation booked successfully! We'll see you soon.";
            } else {
                $error = "Error booking reservation: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }
    }
}
?>

<div class="reservation-hero">
    <div class="container">
        <h1>Make a Reservation</h1>
        <p>Book a table at our restaurant</p>
    </div>
</div>

<div class="container reservation-container">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>
    
    <div class="reservation-form-wrapper">
        <form method="POST" class="reservation-form">
            <div class="form-group">
                <label for="reservation_date">Reservation Date *</label>
                <input type="date" id="reservation_date" name="reservation_date" required>
            </div>
            
            <div class="form-group">
                <label for="reservation_time">Reservation Time *</label>
                <input type="time" id="reservation_time" name="reservation_time" required>
            </div>
            
            <div class="form-group">
                <label for="number_of_guests">Number of Guests *</label>
                <input type="number" id="number_of_guests" name="number_of_guests" min="1" max="20" required>
            </div>
            
            <div class="form-group">
                <label for="special_requests">Special Requests</label>
                <textarea id="special_requests" name="special_requests" rows="4" placeholder="Any special requests or dietary requirements?"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Book Reservation</button>
        </form>
    </div>
</div>

<?php
include 'footer.php';
$conn->close();
?>
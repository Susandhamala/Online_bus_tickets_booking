<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is a customer
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}

// Fetch all routes from the database
$stmt = $pdo->prepare("SELECT routes.*, buses.name AS bus_name FROM routes JOIN buses ON routes.bus_id = buses.id");
$stmt->execute();
$routes = $stmt->fetchAll();

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $route_id = $_POST['route_id'];
    $seat_number = $_POST['seat_number'];
    $user_id = $_SESSION['user_id'];

    // Insert booking into the database
    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, route_id, seat_number) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $route_id, $seat_number]);

    $success = "Booking successful!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Ticket</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Book a Ticket</h1>
        <?php if (isset($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
        <form method="post" action="book_ticket.php">
            <label for="route">Select Route:</label>
            <select id="route" name="route_id" required>
                <?php foreach ($routes as $route): ?>
                    <option value="<?= $route['id'] ?>">
                        Bus: <?= $route['bus_name'] ?> - From: <?= $route['start_location'] ?> To: <?= $route['end_location'] ?>
                        (Departure: <?= $route['departure_time'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="seat_number">Seat Number:</label>
            <input type="text" id="seat_number" name="seat_number" required>
            <button type="submit">Book</button>
        </form>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

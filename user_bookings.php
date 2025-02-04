<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is an admin or manager
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'manager')) {
    header('Location: login.php');
    exit();
}

// Fetch all bookings from the database
$stmt = $pdo->prepare("SELECT bookings.*, users.name AS user_name, users.email AS user_email, routes.start_location, routes.end_location, routes.departure_time, routes.arrival_time
                       FROM bookings 
                       JOIN users ON bookings.user_id = users.id 
                       JOIN routes ON bookings.route_id = routes.id");
$stmt->execute();
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Bookings</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>User Bookings</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Route</th>
                    <th>Seat Number</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= $booking['id'] ?></td>
                        <td><?= $booking['user_name'] ?></td>
                        <td><?= $booking['user_email'] ?></td>
                        <td><?= $booking['start_location'] ?> to <?= $booking['end_location'] ?></td>
                        <td><?= $booking['seat_number'] ?></td>
                        <td><?= $booking['departure_time'] ?></td>
                        <td><?= $booking['arrival_time'] ?></td>
                        <td><?= ucfirst($booking['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

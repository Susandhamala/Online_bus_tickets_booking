<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is a customer
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}

// Fetch the user's bookings from the database
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT bookings.*, routes.start_location, routes.end_location, routes.departure_time, routes.arrival_time, buses.name AS bus_name 
                       FROM bookings 
                       JOIN routes ON bookings.route_id = routes.id 
                       JOIN buses ON routes.bus_id = buses.id 
                       WHERE bookings.user_id = ?");
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Tickets</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>View Tickets</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bus</th>
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
                        <td><?= $booking['bus_name'] ?></td>
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

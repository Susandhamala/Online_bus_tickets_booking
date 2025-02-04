<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is a manager

if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'manager')) {
    header('Location: login.php');
    exit();
}


// Approve or reject booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingId = $_POST['booking_id'];
    $action = $_POST['action'];

    $status = ($action == 'approve') ? 'approved' : 'rejected';
    $stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
    $stmt->execute([$status, $bookingId]);
    
    header('Location: approve_bookings.php');
    exit();
}

// Fetch all pending bookings
$stmt = $pdo->prepare("SELECT bookings.*, users.name AS user_name, routes.start_location, routes.end_location 
                       FROM bookings 
                       JOIN users ON bookings.user_id = users.id 
                       JOIN routes ON bookings.route_id = routes.id 
                       WHERE bookings.status = 'pending'");
$stmt->execute();
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approve Bookings</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Approve Bookings</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Route</th>
                    <th>Seat Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= $booking['id'] ?></td>
                        <td><?= $booking['user_name'] ?></td>
                        <td><?= $booking['start_location'] ?> to <?= $booking['end_location'] ?></td>
                        <td><?= $booking['seat_number'] ?></td>
                        <td>
                            <form method="post" action="approve_bookings.php" style="display:inline;">
                                <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                <button type="submit" name="action" value="approve">Approve</button>
                                <button type="submit" name="action" value="reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

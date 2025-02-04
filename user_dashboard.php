<?php
session_start();
include('header.php'); // Include the header file

// Check if the user is a customer
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'USER';
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>User Dashboard</h1>
        <p>Welcome, <?= htmlspecialchars($name) ?>!</p>
        <nav>
            <ul class="dhamala">
                <li><a href="book_ticket.php">Book a Ticket</a></li>
                <li><a href="view_tickets.php">View Tickets</a></li>
            </ul>
        </nav>
        <p> Use the links above to book a ticket and view your booked tickets.</p>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

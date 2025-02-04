<?php
session_start();
include('header.php'); // Include the header file

// Check if the user is a manager
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header('Location: login.php');
    exit();
}
// Get the user's name from the session
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Manager';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manager Dashboard</h1>
        <p>Welcome, <?= htmlspecialchars($name) ?>!</p>
        <nav>
            <ul class="dhamala">
                <li><a href="manage_routes.php">Manage Routes</a></li>
                <li><a href="approve_bookings.php">Approve Bookings</a></li>
                <li><a href="user_bookings.php">User Bookings</a></li>
            </ul>
        </nav>
        <p>Use the links above to manage routes and approve bookings.</p>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

<?php
session_start();
include('header.php'); // Include the header file

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Manager';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome, BOSS  <?= htmlspecialchars($name) ?>!</p>
        <nav>
            <ul class="dhamala">
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="manage_routes.php">Manage Routes</a></li>
                <li><a href="approve_bookings.php">Approve Bookings</a></li>
                <li><a href="user_bookings.php">User Bookings</a></li>
            </ul>
        </nav>
        <p>BOSS ARE YOU ALRIGHT, WHY YOU REMEMBER ME 😉. </p>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

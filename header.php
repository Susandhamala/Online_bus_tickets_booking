<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Booking System</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Bus Ticket Booking System</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php if (isset($_SESSION['role'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                            <li><a href="manage_users.php">Manage Users</a></li>
                            <li><a href="manage_routes.php">Manage Routes</a></li>
                            <li><a href="approve_bookings.php">Approve Bookings</a></li>
                            <li><a href="user_bookings.php">User Bookings</a></li>
                        <?php elseif ($_SESSION['role'] == 'manager'): ?>
                            <li><a href="manager_dashboard.php">Manager Dashboard</a></li>
                            <li><a href="manage_routes.php">Manage Routes</a></li>
                            <li><a href="approve_bookings.php">Approve Bookings</a></li>
                            <li><a href="user_bookings.php">User Bookings</a></li>
                        <?php elseif ($_SESSION['role'] == 'customer'): ?>
                            <li><a href="user_dashboard.php">User Dashboard</a></li>
                            <li><a href="book_ticket.php">Book a Ticket</a></li>
                            <li><a href="view_tickets.php">View Tickets</a></li>
                        <?php endif; ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>

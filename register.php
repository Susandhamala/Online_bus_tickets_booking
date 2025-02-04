<?php
session_start();
include('database.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'customer'; // Default role

    // Check if all fields are provided
    if (empty($name) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            $error = "Email is already registered.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into database
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword, $role]);

            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Booking System</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="pass.js" defer></script>
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
        <div class="container">
            <h2>Register</h2>
            <?php if (isset($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>
            <form method="post" action="register.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" oninput="checkPassword()" required>
                <label>
                    <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                    Show Password
                </label>
                <p id="message"></p>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>

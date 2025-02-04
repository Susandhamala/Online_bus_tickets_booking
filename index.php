<?php
// Start the session
session_start();
include('header.php');  // Include the header file
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bus Ticket Booking System</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Bus Ticket Booking System</h1>
        <p>Please <a href="login.php">login</a> or <a href="register.php">register</a> to continue.</p>

    </div>
</body>
</html>

<?php
include('footer.php');  // Include the footer file
?>

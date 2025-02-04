<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is an admin or manager
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'manager')) {
    header('Location: login.php');
    exit();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $number_plate = $_POST['number_plate'];
    $total_seats = $_POST['total_seats'];

    // Insert new bus into the database
    $stmt = $pdo->prepare("INSERT INTO buses (name, number_plate, total_seats) VALUES (?, ?, ?)");
    $stmt->execute([$name, $number_plate, $total_seats]);

    $success = "New bus added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Bus</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Bus</h1>
        <?php if (isset($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
        <form method="post" action="add_bus.php">
            <label for="name">Bus Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="number_plate">Number Plate:</label>
            <input type="text" id="number_plate" name="number_plate" required>
            <label for="total_seats">Total Seats:</label>
            <input type="number" id="total_seats" name="total_seats" required>
            <button type="submit">Add Bus</button>
        </form>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

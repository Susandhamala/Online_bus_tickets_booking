<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is an admin or manager
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'manager')) {
    header('Location: login.php');
    exit();
}

// Get the route ID from the query string
$route_id = $_GET['id'];

// Fetch route details from the database
$stmt = $pdo->prepare("SELECT * FROM routes WHERE id = ?");
$stmt->execute([$route_id]);
$route = $stmt->fetch();

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_location = $_POST['start_location'];
    $end_location = $_POST['end_location'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];

    // Update route details in the database
    $stmt = $pdo->prepare("UPDATE routes SET start_location = ?, end_location = ?, departure_time = ?, arrival_time = ? WHERE id = ?");
    $stmt->execute([$start_location, $end_location, $departure_time, $arrival_time, $route_id]);

    $success = "Route details updated successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Route</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Route</h1>
        <?php if (isset($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
        <form method="post" action="edit_route.php?id=<?= $route_id ?>">
            <label for="start_location">Start Location:</label>
            <input type="text" id="start_location" name="start_location" value="<?= $route['start_location'] ?>" required>
            <label for="end_location">End Location:</label>
            <input type="text" id="end_location" name="end_location" value="<?= $route['end_location'] ?>" required>
            <label for="departure_time">Departure Time:</label>
            <input type="datetime-local" id="departure_time" name="departure_time" value="<?= $route['departure_time'] ?>" required>
            <label for="arrival_time">Arrival Time:</label>
            <input type="datetime-local" id="arrival_time" name="arrival_time" value="<?= $route['arrival_time'] ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

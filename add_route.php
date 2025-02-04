<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is an admin or manager
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'manager')) {
    header('Location: login.php');
    exit();
}

// Fetch all buses from the database
$stmt = $pdo->prepare("SELECT * FROM buses");
$stmt->execute();
$buses = $stmt->fetchAll();

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bus_id = $_POST['bus_id'];
    $start_location = $_POST['start_location'];
    $end_location = $_POST['end_location'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];

    // Insert new route into the database
    $stmt = $pdo->prepare("INSERT INTO routes (bus_id, start_location, end_location, departure_time, arrival_time) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$bus_id, $start_location, $end_location, $departure_time, $arrival_time]);

    $success = "New route added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Route</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="add-route-container">
    <h1>Add New Route</h1>
    <?php if (isset($success)): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>
    <form method="post" action="add_route.php">
        <label for="bus">Select Bus:</label>
        <select id="bus" name="bus_id" required>
            <?php foreach ($buses as $bus): ?>
                <option value="<?= $bus['id'] ?>"><?= $bus['name'] ?> (<?= $bus['number_plate'] ?>)</option>
            <?php endforeach; ?>
        </select>
        <label for="start_location">Start Location:</label>
        <input type="text" id="start_location" name="start_location" required>
        <label for="end_location">End Location:</label>
        <input type="text" id="end_location" name="end_location" required>
        <label for="departure_time">Departure Time:</label>
        <input type="datetime-local" id="departure_time" name="departure_time" required>
        <label for="arrival_time">Arrival Time:</label>
        <input type="datetime-local" id="arrival_time" name="arrival_time" required>
        <button type="submit">Add Route</button>
    </form>
</div>

</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

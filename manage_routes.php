<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is an admin or manager
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'manager')) {
    header('Location: login.php');
    exit();
}

// Fetch all routes from the database
$stmt = $pdo->prepare("SELECT routes.*, buses.name AS bus_name FROM routes JOIN buses ON routes.bus_id = buses.id");
$stmt->execute();
$routes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Routes</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Routes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bus</th>
                    <th>Start Location</th>
                    <th>End Location</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($routes as $route): ?>
                    <tr>
                        <td><?= $route['id'] ?></td>
                        <td><?= $route['bus_name'] ?></td>
                        <td><?= $route['start_location'] ?></td>
                        <td><?= $route['end_location'] ?></td>
                        <td><?= $route['departure_time'] ?></td>
                        <td><?= $route['arrival_time'] ?></td>
                        <td>
                            <a href="edit_route.php?id=<?= $route['id'] ?>">Edit</a>
                            <a href="delete.php?type=route&id=<?= $route['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_route.php" class="btn">Add New Route</a>
        <a href="add_bus.php" class="btn">Add New Bus</a>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

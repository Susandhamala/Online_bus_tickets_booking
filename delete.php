<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is an admin or manager
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'manager')) {
    header('Location: login.php');
    exit();
}

// Check if 'type' and 'id' parameters are set in the query string
if (!isset($_GET['type']) || !isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

// Get the type and ID from the query string
$type = $_GET['type'];
$id = $_GET['id'];

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($type == 'route') {
        // Delete the route from the database
        $stmt = $pdo->prepare("DELETE FROM routes WHERE id = ?");
        $stmt->execute([$id]);
        $redirect_url = 'manage_routes.php';
    } elseif ($type == 'user') {
        // Delete the user from the database
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $redirect_url = 'manage_users.php';
    }

    // Redirect to the appropriate management page
    header("Location: $redirect_url");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Delete Confirmation</h1>
        <p>Are you sure you want to delete this item?</p>
        <form method="post" action="delete.php?type=<?= $type ?>&id=<?= $id ?>">
            <button type="submit" class="btn">Yes, Delete</button>
            <a href="<?= ($type == 'route') ? 'manage_routes.php' : 'manage_users.php' ?>" class="btn">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

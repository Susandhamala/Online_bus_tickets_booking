<?php
session_start();
include('header.php'); // Include the header file
include('database.php'); // Include database connection

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Get the user ID from the query string
$user_id = $_GET['id'];

// Fetch user details from the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Update user details in the database
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
    $stmt->execute([$name, $email, $role, $user_id]);

    $success = "User details updated successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <?php if (isset($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
        <form method="post" action="edit_user.php?id=<?= $user_id ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= $user['name'] ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="manager" <?= $user['role'] == 'manager' ? 'selected' : '' ?>>Manager</option>
                <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php include('footer.php'); // Include the footer file ?>

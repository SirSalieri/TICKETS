<?php
session_start();
require_once __DIR__ . '/../includes/connect.php';

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password
    $role = $_POST['role'];

    $insert_stmt = $conn->prepare("INSERT INTO users (name, surname, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
    $insertSuccess = $insert_stmt->execute([$name, $surname, $username, $email, $password, $role]);

    if ($insertSuccess) {
        $successMessage = "New user added successfully.";
    } else {
        $successMessage = "Failed to add a new user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/../TICKETS/dashboard/admin_panel.php">Back to Admin's Panel</a>
        <div class="ml-auto">
            <a href="../LOG_IN_SYSTEM/logout.php" class="btn btn-outline-light">Logg ut</a>
        </div>
    </div>
</nav>


<div class="container mt-3">
    <a href="management.php" style="text-decoration: none;">&larr; Tilbake til Users Management Dashboard</a>
</div>

    <div class="container mt-5">
        <?php if ($successMessage): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
                <a href="/../TICKETS/dashboard/admin_panel.php" class="btn btn-primary">Back to Dashboard</a>
            </div>
        <?php endif; ?>

        <h2>Add New User</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role">
                    <option value="admin">Admin</option>
                    <option value="user" selected>User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>

    <footer class="footer bg-primary text-white mt-4">
        <div class="container text-center py-3">
            <p>&copy; 2024 Fjell</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

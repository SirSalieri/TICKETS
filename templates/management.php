<?php
session_start();
require_once __DIR__ . '/../includes/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Management</title>
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
        <a href="/../TICKETS/dashboard/admin_panel.php" style="text-decoration: none;">&larr; Tilbake til Panelen</a>
    </div>

    <div class="container mt-2">
        <h1>Users - Management Dashboard</h1>
        <div class="mb-5">
            <a href="admin_users.php" class="btn btn-primary">Admin Users</a>
            <a href="non_admin_users.php" class="btn btn-secondary">Non-Admin Users</a>
            <a href="add_user.php" class="btn btn-success">Add New User</a>
        </div>
        
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

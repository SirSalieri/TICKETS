<?
require_once 'authentication.php';
require_once __DIR__ . '/vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* Du kan legge til egendefinert CSS her for å tilpasse knapper eller andre elementer ytterligere */
        .button-container {
            margin-bottom: 20px; /* Gir litt mer plass mellom knappene */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="../LOG_IN_SYSTEM/logout.php" class="btn btn-outline-light">LOGG UT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 text-center">
    <h1>Welcome to the Admin Panel!</h1>
    <div class="row mt-4 justify-content-center">
        <div class="col-md-4 button-container">
            <a href="/TICKETS/templates/management.php" class="btn btn-primary btn-lg btn-block">Manage Users</a>
        </div>
        <div class="col-md-4 button-container">
            <a href="/TICKETS/templates/articles.php" class="btn btn-secondary btn-lg btn-block">Manage Articles</a>
        </div>
        <div class="col-md-4 button-container">
            <a href="/TICKETS/templates/last_login.php" class="btn btn-success btn-lg btn-block">Activity Tracker</a>
        </div>
        <div class="col-md-4 button-container">
            <a href="/TICKETS/templates/tickets.php" class="btn btn-info btn-lg btn-block">Manage Tickets</a>
        </div>
    </div>
</div>

<footer class="footer bg-primary text-white mt-4">
    <div class="container text-center py-3">
        <p>&copy; 2023 Fjell</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

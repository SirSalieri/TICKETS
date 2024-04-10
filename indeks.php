<?php
session_start();
$logout_message = "";
if (isset($_SESSION['logout_message'])) {
    $logout_message = $_SESSION['logout_message'];
    unset($_SESSION['logout_message']);
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velkommen til Kundeservice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<?php if ($logout_message != ""): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $logout_message; ?>
    </div>
<?php endif; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="https://fjelltg.no/">&copy; 2024 Fjell</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">Velkommen til Kundeservice!</h1>
        <p class="lead">Vi er her for å hjelpe deg med alle dine forespørsler.</p>
        <hr class="my-4">
        <p>Logg inn for å sjekke status på din henvendelse eller sende en ny henvendelse.</p>
        <a class="btn btn-primary btn-lg" href="LOG_IN_SYSTEM\login.php" role="button">Logg inn</a>
        <a class="btn btn-secondary btn-lg" href="LOG_IN_SYSTEM\register.php" role="button">Registrer deg</a>
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

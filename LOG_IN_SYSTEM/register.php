
<?php
require_once '../includes/connect.php'; // Oppdater stien etter behov

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Husk å hashe passordet før lagring!
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password); // passord bør hashes
        $stmt->execute();

        if ($conn->affected_rows > 0) {
            $message = "Konto opprettet! Du kan nå logge inn.";
        } else {
            $message = "Feil ved registrering.";
        }
    } else {
        $message = "Passordene matcher ikke.";
    }
}

?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer Deg - Kundeservice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
    <a class="navbar-brand" href="https://fjelltg.no/">&copy; 2024 Fjell</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a href="login.php" class="btn btn-outline-light">Logg Inn</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Registrer Deg</h3>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-warning text-center">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="handle_registration.php" method="post">
                        <div class="form-group">
                            <label for="name">Navn og Etternavn</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-post</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Passord</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirm">Bekreft Passord</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrer</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>Har du allerede en konto? <a href="login.php">Logg Inn her</a>!</p>
            </div>
        </div>
    </div>
</div>

<footer class="footer bg-primary text-white mt-5">
    <div class="container text-center py-3">
        <p>&copy; 2024 Fjell</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

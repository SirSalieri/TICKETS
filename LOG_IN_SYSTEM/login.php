<?php
session_start();
require_once '../includes/connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role']; 

        if ($_SESSION['role'] === 'admin') {
            header("Location: admin_index.php");
        } else {
            header("Location: login_kunde.php"); 
        }
        exit;
    } else {
        $message = 'Login feilet: Ugyldig brukernavn eller passord';
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>


<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logg Inn - Kundeservice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="https://fjelltg.no/">&copy; 2024 Fjell</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="register.php" class="btn btn-outline-light">Registrer deg!</a>
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
                    <h3 class="card-title text-center mb-4">Logg Inn</h3>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-warning text-center">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="handle_login.php" method="post">
                        <div class="form-group">
                            <label for="email">E-post</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Passord</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Logg Inn</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>Har du ikke en konto? <a href="register.php">Registrer deg nå</a>.</p>
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

<?php
session_start();
require_once '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    $ticket_number = uniqid();

    $sql = "INSERT INTO tickets (name, email, description, ticket_number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $description);
    $stmt->bindParam(4, $ticket_number);

    try {
        $stmt->execute();
        $message = "Din henvendelse er sendt inn. Ditt saksnummer er: " . $ticket_number;
    } catch (PDOException $e) {
        error_log("Submission failed: " . $e->getMessage());
        $message = "Det oppstod en feil ved innsending av henvendelsen. Vennligst prøv igjen.";
    }
}
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kundeservice - Din Side</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="https://fjelltg.no/">&copy; 2024 Fjell</a>
        <div class="ml-auto">
            <a href="../LOG_IN_SYSTEM/logout.php" class="btn btn-outline-light">Logg ut</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Velkommen, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Gjest'); ?>!</h1>
        <p class="lead">Her kan du enkelt sende inn henvendelser og sjekke status på dine saker.</p>
    </div>

    <?php if (isset($_SESSION['user_name'], $_SESSION['user_surname'])): ?>
    <h1 class="display-4">Velkommen, <?php echo htmlspecialchars($_SESSION['user_name']) . ' ' . htmlspecialchars($_SESSION['user_surname']); ?>!</h1>
    <?php else: ?>
        <h1 class="display-4">Velkommen, Gjest!</h1>
    <?php endif; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Send inn henvendelse
                </div>
                <div class="card-body">
                    <?php if (isset($message)) echo "<p class='alert alert-info'>$message</p>"; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Navn</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-post</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Beskrivelse av problemet</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send inn henvendelse</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Sjekk status på henvendelsen
                </div>
                <div class="card-body">
                    <form action="/../TICKETS/templates/check_status.php" method="post">
                        <div class="form-group">
                            <label for="ticket_number">Saksnummer</label>
                            <input type="text" class="form-control" id="ticket_number" name="ticket_number" required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Sjekk status</button>
                    </form>
                </div>
            </div>
        </div>
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

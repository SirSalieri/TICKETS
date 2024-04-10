<?php
require_once '../includes/connect.php';

$result = null;
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_number = $_POST['ticket_number'];

    $sql = "SELECT name, email, description, status, created_at, updated_at FROM tickets WHERE ticket_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $ticket_number);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $message = "Fant ingen henvendelse med det saksnummeret.";
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status for Henvendelse</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Kundeservice</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard/login_kunde.php">Tilbake til Min side!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../LOG_IN_SYSTEM/logout.php">Logg ut</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Sjekk status på henvendelsen din</h4>
                </div>
                <div class="card-body">
                    <form action="check_status.php" method="post">
                        <div class="form-group">
                            <label for="ticket_number">Saksnummer</label>
                            <input type="text" class="form-control" id="ticket_number" name="ticket_number" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sjekk status</button>
                    </form>
                </div>
            </div>
            <?php if ($result): ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title">Detaljer for henvendelsen</h4>
                        <p class="card-text">Navn: <?php echo htmlspecialchars($result['name']); ?></p>
                        <p class="card-text">E-post: <?php echo htmlspecialchars($result['email']); ?></p>
                        <p class="card-text">Beskrivelse: <?php echo htmlspecialchars($result['description']); ?></p>
                        <p class="card-text">Status: <?php echo htmlspecialchars($result['status']); ?></p>
                        <p class="card-text">Opprettet: <?php echo htmlspecialchars($result['created_at']); ?></p>
                        <p class="card-text">Sist oppdatert: <?php echo htmlspecialchars($result['updated_at']); ?></p>
                    </div>
                </div>
            <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <div class="alert alert-warning mt-4" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
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

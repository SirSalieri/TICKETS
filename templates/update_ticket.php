<?php
// require_once '../includes/authentication.php';
require_once __DIR__ . '\..\vendor\autoload.php';
require_once __DIR__ . '\..\includes\connect.php';

$message = '';

if(isset($_GET['ticket_id']) && is_numeric($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];

    $stmt = $conn->prepare("SELECT * FROM tickets WHERE id = ?");
    $stmt->bindParam(1, $ticket_id, PDO::PARAM_INT);
    $stmt->execute();
    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$ticket) {
        $message = 'Henvendelsen finnes ikke.';
    }
} else {
    $message = 'Ugyldig henvendelse ID.';
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'], $_POST['ticket_id'])) {
    $status = $_POST['status'];
    $ticket_id = $_POST['ticket_id'];

    $stmt = $conn->prepare("UPDATE tickets SET status = ? WHERE id = ?");
    $stmt->bindParam(1, $status, PDO::PARAM_STR);
    $stmt->bindParam(2, $ticket_id, PDO::PARAM_INT);
    $stmt->execute();

    if($stmt->rowCount()) {
        $message = 'Status oppdatert.';
    } else {
        $message = 'Ingen endringer ble gjort.';
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oppdater Henvendelse</title>
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
    <a href="tickets.php" style="text-decoration: none;">&larr; Tilbake til Saklista</a>
</div>

<div class="container mt-2">
    <h2>Oppdater Henvendelse</h2>
    <?php if($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <?php if($ticket): ?>
        <form action="update_ticket.php" method="post">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="Åpen" <?php echo $ticket['status'] === 'Åpen' ? 'selected' : ''; ?>>Åpen</option>
                    <option value="Under behandling" <?php echo $ticket['status'] === 'Under behandling' ? 'selected' : ''; ?>>Under behandling</option>
                    <option value="Løst" <?php echo $ticket['status'] === 'Løst' ? 'selected' : ''; ?>>Løst</option>
                </select>
            </div>
            <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
            <button type="submit" class="btn btn-primary">Oppdater</button>
        </form>
    <?php endif; ?>
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

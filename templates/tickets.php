<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Database-tilkobling
require_once __DIR__ . '/../includes/connect.php'; // Endre til korrekt sti

try {
    $stmt = $conn->prepare("SELECT * FROM tickets ORDER BY created_at DESC");
    $stmt->execute();
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Kunne ikke hente henvendelser: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Henvendelser</title>
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
    <h1>Administrer Henvendelser</h1>
    <div class="mt-4">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Saksnummer</th>
                    <th scope="col">Navn</th>
                    <th scope="col">E-post</th>
                    <th scope="col">Beskrivelse</th>
                    <th scope="col">Status</th>
                    <th scope="col">Handlinger</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($ticket['id']); ?></th>
                    <td><?php echo htmlspecialchars($ticket['ticket_number']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['name']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['email']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['description']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['status']); ?></td>
                    <td>
                        <!-- Knapper for å håndtere statusoppdateringer eller sletting -->
                        <a href="update_ticket.php?ticket_id=<?php echo $ticket['id']; ?>" class="btn btn-primary btn-sm">Oppdater</a>
                        <a href="delete_ticket.php?ticket_id=<?php echo $ticket['id']; ?>" class="btn btn-danger btn-sm">Slett</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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

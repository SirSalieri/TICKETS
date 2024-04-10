<?php
session_start();
require_once __DIR__ . '/../includes/connect.php';
// require_once __DIR__ . '/../includes/authentication.php'; 

$message = '';
$userData = null;

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("UPDATE users SET name = ?, role = ? WHERE id = ?");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $role);
        $stmt->bindParam(3, $userId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $message = "Brukeren ble oppdatert.";
        } else {
            $message = "Ingen endringer ble gjort.";
        }
    } 

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bindParam(1, $userId);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediger Bruker</title>
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
        <h2>Rediger Bruker</h2>
        <?php if ($message): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="rediger_bruker.php?id=<?php echo htmlspecialchars($userId); ?>" method="post">
            <div class="form-group">
                <label for="name">Navn</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($userData['name'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Rolle</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="user" <?php echo ($userData['role'] ?? '') === 'user' ? 'selected' : ''; ?>>USER</option>
                    <option value="admin" <?php echo ($userData['role'] ?? '') === 'admin' ? 'selected' : ''; ?>>ADMIN</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Oppdater Bruker</button>
        </form>
    </div>

    <footer class="footer bg-primary text-white mt-5">
        <div class="container text-center py-3">
            <p>&copy; 2024 Fjell</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

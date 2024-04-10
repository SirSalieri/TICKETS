<?php
session_start();
require_once __DIR__ . '/../includes/connect.php';

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header("Location: unauthorized_page.html");
//     exit();
// }

$message = '';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "Brukeren med ID $userId er slettet.";
    } else {
        $_SESSION['message'] = "Det oppstod en feil ved forsøket på å slette brukeren.";
    }
    
    header("Location: admin_users.php");
    exit(); 
}
?>


<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slett Bruker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <!-- Navigation and header as per your design -->
    <!-- Rest of the body -->
    <div class="container mt-5">
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
        <a href="admin_users.php" class="btn btn-primary">Tilbake til brukerlisten</a>
    </div>
    <!-- Bootstrap JS and other dependencies -->
    <!-- Rest of your scripts -->
</body>
</html>

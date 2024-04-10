<?php
// require_once '../includes/authentication.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/connect.php'; // Endre til korrekt sti

// Sjekk om ticket_id er satt og er et tall
if(isset($_GET['ticket_id']) && is_numeric($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];

    // Slett henvendelsen fra databasen
    $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
    $stmt->bindParam(1, $ticket_id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect til admin panel eller til en bekreftelse side
    header('Location: admin_panel.php?delete=success');
    exit;
} else {
    echo 'Ugyldig henvendelse ID.';
    // Her kan du også redirecte eller vise en feilmelding
}

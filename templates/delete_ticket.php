<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/connect.php';

if(isset($_GET['ticket_id']) && is_numeric($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];

    $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
    $stmt->bindParam(1, $ticket_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: admin_panel.php?delete=success');
    exit;
} else {
    echo 'Ugyldig henvendelse ID.';
}

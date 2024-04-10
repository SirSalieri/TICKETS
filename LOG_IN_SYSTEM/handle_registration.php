<?php
require_once '../includes/connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password_confirm'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Sjekk først om brukeren allerede finnes
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $hashed_password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = "Registrering vellykket. Du kan nå logge inn.";
                header("Location: login.php");
                exit();
            } else {
                $message = "Kunne ikke registrere bruker.";
            }
        } else {
            $message = "En bruker med denne e-postadressen finnes allerede.";
        }
    } else {
        $message = "Passordene matcher ikke.";
    }
} else {
    $message = "Alle felter må fylles ut.";
}

session_start();
$_SESSION['message'] = $message;
header("Location: register.php");
exit();
?>

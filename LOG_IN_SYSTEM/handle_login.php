<?php
session_start();
require_once '../includes/connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hent brukerinformasjonen basert på e-post
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    
    // Hent brukeren fra databasen
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Sjekk om brukeren eksisterer og passordet er korrekt
    if ($user && password_verify($password, $user['password'])) {
        // Lagre brukerinformasjon i session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name']; 
        $_SESSION['user_surname'] = $user['surname']; 
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role']; // Lagre brukerrollen

        // Omdiriger til riktig dashboard basert på brukerrollen
        if ($_SESSION['role'] === 'admin') {
            header("Location: ../dashboard/admin_panel.php");
        } else {
            header("Location: ../dashboard/login_kunde.php");
        }
        exit;
    } else {
        // Sett en feilmelding og omdiriger tilbake til innloggingssiden
        $_SESSION['message'] = 'Login feilet: Ugyldig brukernavn eller passord';
        header("Location: login.php");
        exit;
    }
}
?>

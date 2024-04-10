<?php
session_start();
require_once '../includes/connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Lagre brukerinformasjon i session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name']; 
        $_SESSION['user_surname'] = $user['surname']; 
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($_SESSION['role'] === 'admin') {
            header("Location: ../dashboard/admin_panel.php");
        } else {
            header("Location: ../dashboard/login_kunde.php");
        }
        exit;
    } else {
        $_SESSION['message'] = 'Login feilet: Ugyldig brukernavn eller passord';
        header("Location: login.php");
        exit;
    }
}
?>

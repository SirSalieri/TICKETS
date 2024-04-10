<?php
session_start();

$_SESSION = array();

session_destroy();

session_start();
$_SESSION['logout_message'] = "Du har logget ut!";

header('Location: ../indeks.php');
exit;
?>

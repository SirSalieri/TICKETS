<?php
session_start();
require_once __DIR__ . '/../includes/connect.php';
// require_once __DIR__ . '/../includes/authentication.php'; 

$searched_id = '';
$article_data = null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['id'])) {
    $searched_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = :id");
    $stmt->bindParam(':id', $searched_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $article_data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $message = "Article data is not available. Please check if the article ID is correct.";
    }
}

// Include your HTML and form for searching articles here.
?>

<!-- The rest of your HTML goes here, including the search form -->

<?php
require_once '../config/database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'])) {
    $database = new Database();
    $pdo = $database->connect();
    $userId = $_SESSION['user_id'];
    $bookId = $_POST['book_id'];

    $stmt = $pdo->prepare("SELECT added_by FROM books WHERE id = ?");
    $stmt->execute([$bookId]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book || $book['added_by'] != $userId) {
        $_SESSION['message'] = "You can only delete books you added.";
        header("Location: ../views/dashboard.php");
        exit();
    }

    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$bookId]);

    $_SESSION['message'] = "Book deleted successfully.";
    header("Location: ../views/dashboard.php");
    exit();
}
?>

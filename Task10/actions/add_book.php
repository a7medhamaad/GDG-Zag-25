<?php
require_once '../config/database.php';
require_once '../classes/User.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

$database = new Database();
$pdo = $database->connect();
$user = new User($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'], $_POST['author'])) {
    $database = new Database();
    $pdo = $database->connect();
    $userId = $_SESSION['user_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    if (empty($title) || empty($author)) {
        $_SESSION['message'] = "Title and Author fields are required.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO books (title, author, added_by, isAvailable) VALUES (?, ?, ?, 1)");
        if ($stmt->execute([$title, $author, $userId])) {
            $_SESSION['message'] = "Book added successfully.";
        } else {
            $_SESSION['message'] = "Error adding book.";
        }
    }
}

header("Location: ../views/dashboard.php");
exit();
?>

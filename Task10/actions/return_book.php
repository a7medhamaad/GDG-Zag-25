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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];
    $message = $user->returnBook($_SESSION['user_id'], $bookId);
    $_SESSION['message'] = $message;
}

header("Location: ../views/dashboard.php");
exit();
?>

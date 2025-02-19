<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];
    $comment = $_POST['comment'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
    $stmt->execute([$postId, $userId, $comment]);

    header("Location: post.php?id=$postId");
    exit;
}
?>
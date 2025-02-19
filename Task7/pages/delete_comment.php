<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$commentId = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
$stmt->execute([$commentId]);
$comment = $stmt->fetch();



$stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
$stmt->execute([$commentId]);

header('Location: post.php?id=' . $comment['post_id']);
exit;
?>
<?php
session_start();
require '../includes/db.php';
require '../includes/header.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $title, $content]);

    header('Location: index.php');
    exit;
}
?>


<div class="form-container">
    <h1>Create New Post</h1>
    <form method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <button type="submit" class="btn-submit">Create Post</button>
    </form>
</div>


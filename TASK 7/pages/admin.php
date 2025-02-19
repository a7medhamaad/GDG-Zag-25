<?php
session_start();
require '../includes/db.php';
require '../includes/header.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}
$posts = $pdo->query("SELECT * FROM posts")->fetchAll();
$comments = $pdo->query("SELECT * FROM comments")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

</head>
<body>

<div class="container">
    <h1>Admin Dashboard</h1>

    <h2>Posts</h2>
    <ul>
        <?php foreach ($posts as $post): ?>
            <hr>
            <li><?= htmlspecialchars($post['title']) ?> 
                <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn-edit">Edit</a>
                <a href="delete_post.php?id=<?= $post['id'] ?> " class="btn-delete">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Comments</h2>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <hr>
            <li><?= htmlspecialchars($comment['comment']) ?> 
                <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn-edit">Edit</a>
                <a href="delete_comment.php?id=<?= $comment['id'] ?>" class="btn-delete">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>



</body>
</html>

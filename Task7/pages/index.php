<?php
session_start();
require '../includes/db.php';
require '../includes/header.php';

// Fetch all posts with error handling
try {
    $stmt = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
    $posts = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching posts: " . $e->getMessage());
}
?>


<div class="container">
    <h1>Blog Posts</h1>
    <?php if (isLoggedIn()): ?>
        <a href="create_post.php" class="btn-create">Create New Post</a>
    <?php endif; ?>

    <?php if (empty($posts)): ?>
        <p>No posts found. Be the first to create one!</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <div class="meta">
                    By <strong><?= htmlspecialchars($post['username']) ?></strong> on <?= $post['created_at'] ?>
                </div>
                <div class="content">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </div>
                <div class="actions">
                    <a href="post.php?id=<?= $post['id'] ?>" class="btn-read">Read More</a>
                    <?php if (canEditPost($post['user_id'])): ?>
                        <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn-edit">Edit</a>
                        <a href="delete_post.php?id=<?= $post['id'] ?>" class="btn-delete">Delete</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


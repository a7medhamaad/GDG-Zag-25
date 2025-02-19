<?php
session_start();
require '../includes/db.php';
require '../includes/header.php';

$postId = $_GET['id'];
$stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->execute([$postId]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: index.php');
    exit;
}

// Fetch comments
$stmt = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ? ORDER BY created_at DESC");
$stmt->execute([$postId]);
$comments = $stmt->fetchAll();
?>



<div class="container">
    <div class="post">
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <div class="meta">
            By <strong><?= htmlspecialchars($post['username']) ?></strong> on <?= $post['created_at'] ?>
        </div>
        <div class="content">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>
        <div class="actions">
            <?php if (canEditPost($post['user_id'])): ?>
                <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn-edit">Edit</a>
                <a href="delete_post.php?id=<?= $post['id'] ?>" class="btn-delete">Delete</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="comment-section">
        <h2>Comments</h2>
        <?php if (isLoggedIn()): ?>
            <form method="POST" action="comment.php" class="comment-form">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <textarea name="comment" placeholder="Add a comment" required></textarea>
                <button type="submit" class="btn-submit">Submit</button>
            </form>
        <?php endif; ?>

        <?php if (empty($comments)): ?>
            <p>No comments yet. Be the first to comment!</p>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <div class="meta">
                        <strong><?= htmlspecialchars($comment['username']) ?></strong> on <?= $comment['created_at'] ?>
                    </div>
                    <div class="content">
                        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
                    </div>
                    
                    <?php if (isset($_SESSION['user_id']) && (isAdmin() || (isset($comment['user_id']) && $comment['user_id'] == $_SESSION['user_id']))): ?>
                        <div class="actions">
                            <a href="delete_comment.php?id=<?= htmlspecialchars($comment['id']) ?>" class="btn-delete">Delete</a>
                        </div>
                    <?php endif; ?>

                    
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


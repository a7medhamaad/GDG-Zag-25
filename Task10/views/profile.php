<?php
require_once '../config/database.php';
require_once '../classes/User.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$pdo = $database->connect();
$user = new User($pdo);

$borrowedBooks = $user->getBorrowedBooks($_SESSION['user_id']);
?>

<div class="container mt-4">
    <h2>Your Borrowed Books</h2>

    <?php if (!empty($borrowedBooks)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrowedBooks as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['title']); ?></td>
                        <td><?= htmlspecialchars($book['author']); ?></td>
                        <td>
                            <form action="../actions/return_book.php" method="POST">
                                <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
                                <button type="submit" class="btn btn-danger">Return</button>
                            </form>
                            <form action="../actions/remove_book.php" method="POST" style="display:inline;">
                                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    <?php else: ?>
        <p>You haven't borrowed any books.</p>
    <?php endif; ?>
</div>

<div class="container mt-4">
    <h2>Add a New Book</h2>
    <form action="../actions/add_book.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <button type="submit" class="btn btn-success">Add Book</button>
    </form>
</div>

<?php include 'footer.php'; ?>
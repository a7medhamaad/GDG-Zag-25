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
$userId = $_SESSION['user_id'];

$stmt = $pdo->query("SELECT books.*, borrowed_books.user_id AS borrowed_by FROM books 
                     LEFT JOIN borrowed_books ON books.id = borrowed_books.book_id");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Available Books</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['title']); ?></td>
                    <td><?= htmlspecialchars($book['author']); ?></td>
                    <td>
                        <?php if ($book['borrowed_by'] == $userId): ?>
                            <form action="../actions/return_book.php" method="POST" style="display:inline;">
                                <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
                                <button type="submit" class="btn btn-danger">Return</button>
                            </form>
                        <?php elseif ($book['borrowed_by'] == null): ?>
                            <form action="../actions/borrow_book.php" method="POST" style="display:inline;">
                                <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
                                <button type="submit" class="btn btn-primary">Borrow</button>
                            </form>
                        <?php else: ?>
                            <button class="btn btn-secondary" disabled>Not Available</button>
                        <?php endif; ?>

                        <?php if ($book['added_by'] == $userId): ?>
                            <form action="../actions/remove_book.php" method="POST" style="display:inline;">
                                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
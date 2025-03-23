<?php
require_once '../config/database.php';
require_once '../classes/User.php';

$database = new Database();
$pdo = $database->connect();
$user = new User($pdo);

include '../views/header.php';
?>

<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to the Library</h1>
        <p class="lead">Manage and borrow books easily.</p>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Hello, <strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong>! Explore the books available.</p>
            <a class="btn btn-primary" href="../views/dashboard.php">View Books</a>
            <a class="btn btn-secondary" href="../views/dashboard.php">Dashboard</a>
        <?php else: ?>
            <a class="btn btn-primary" href="../views/login.php">Login</a>
            <a class="btn btn-success" href="../views/register.php">Register</a>
        <?php endif; ?>
    </div>
</div>

<?php include '../views/footer.php';?>

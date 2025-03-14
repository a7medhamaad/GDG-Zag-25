<?php
include '../views/header.php';
require_once '../config/database.php';
require_once '../classes/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user = new User();
$userData = $user->getUserById($_SESSION['user_id']);
?>

<h2>Welcome, <?php echo htmlspecialchars($userData['name']); ?>!</h2>
<p>Manage your products efficiently.</p>

<a href="products.php" class="btn btn-primary">Manage Products</a>
<a href="profile.php" class="btn btn-secondary">View Profile</a>



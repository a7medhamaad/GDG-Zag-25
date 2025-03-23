<?php
session_start();
require_once '../config/database.php';
require_once '../classes/User.php';

$database = new Database();
$pdo = $database->connect();
$userClass = new User($pdo);

$user = null;
if (isset($_SESSION['user_id'])) {
    $user = $userClass->getUserById($_SESSION['user_id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../public/index.php">Library</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <?php if ($user): ?>
                    <li class="nav-item"><a class="nav-link" href="../views/dashboard.php">Dashboard</a></li>

                    <li class="nav-item">
                        <a class="nav-link" href="../views/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../actions/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="../views/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="../views/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Product Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Product Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="views/dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="views/profile.php">Profile</a></li>
                    <li class="nav-item">
                            <a class="nav-link btn btn-danger text-white" href="controllers/authcontroller.php?logout=true">Logout</a>
                        </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="views/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white" href="views/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<header class="hero-section text-center text-white d-flex align-items-center justify-content-center">
    <div class="container">
        <h1>Welcome to Product Management System</h1>
        <p class="lead">Effortlessly manage your products with our secure and user-friendly platform.</p>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="views/register.php" class="btn btn-primary btn-lg">Get Started</a>
            <a href="views/login.php" class="btn btn-outline-light btn-lg">Login</a>
        <?php else: ?>
            <a href="views/dashboard.php" class="btn btn-success btn-lg">Go to Dashboard</a>
        <?php endif; ?>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

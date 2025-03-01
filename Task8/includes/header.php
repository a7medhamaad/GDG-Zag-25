<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="/ecommerce-gdg/assets/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <a href="/ecommerce-gdg/index.php">Home</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/ecommerce-gdg/cart/index.php">Cart</a> 
                <a href="/ecommerce-gdg/auth/logout.php">Logout</a> 
            <?php else: ?>
                <a href="/ecommerce-gdg/auth/login.php">Login</a> 
                <a href="/ecommerce-gdg/auth/register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
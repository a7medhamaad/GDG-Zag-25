<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog System</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <nav>
             <?php include '../includes/functions.php'; ?>
            <a href="../pages/index.php">Home</a>
            <?php if (isLoggedIn()): ?>
                <a href="../pages/create_post.php">Create Post</a>
                <a href="../pages/logout.php">Logout</a>
            <?php else: ?>
                <a href="../pages/register.php">Register</a>
                <a href="../pages/login.php">Login</a>
            <?php endif; ?>
            <?php if (isAdmin()): ?>
                <a href="../pages/admin.php">Admin Dashboard</a>
            <?php endif; ?>
        </nav>
    </header>
<?php
include '../includes/db.php';
 include '../includes/header.php'; 
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../index.php');
        exit;
    } else {
        echo "Invalid credentials!";
    }
}
?>

<div class="container">
    <div class="form-container">
        <h1>Login</h1>
        <form method="POST" action="">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p class="text-center mt-20">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
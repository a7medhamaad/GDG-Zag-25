<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    header('Location: login.php');
    exit;
}
include '../includes/header.php';
?>

<div class="container">
    <div class="form-container">
        <h1>Register</h1>
        <form method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required>
            
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required>
           
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
         
            <button type="submit" class="btn">Register</button>
        </form>
        <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
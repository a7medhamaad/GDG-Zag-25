<?php 
include_once 'header.php';
?>
<?php 
session_start();
if (isset($_SESSION["userid"])) {
    header("Location: profile.php"); // Redirect if already logged in
    exit();
}
?>

<div class="login-form">
    <h2>Login</h2>
    <form action="include/login.inc.php" method="post">
        <input type="text" name="name" placeholder="write your name">
        <input type="password" name="pwd" placeholder="write complex pass">
        <button type="submit" name="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
</div>

<?php 
include_once 'footer.php';
?>
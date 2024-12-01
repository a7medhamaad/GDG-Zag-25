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
<div class="signup-form">
    <h2>Signup</h2>
    <form action="include/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="write your name">
        <input type="email" name="email" placeholder="write your email">
        <input type="text" name="fullname" placeholder="write your fullname">
        <input type="password" name="pwd" placeholder="write complex pass">
        <input type="password" name="pwdagain" placeholder="write your pass again">
        <button type="submit" name="submit">Signup</button>
    </form>
</div>

<?php 
include_once 'footer.php';
?>
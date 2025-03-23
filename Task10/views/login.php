<?php include 'header.php'; ?>
<h2>Login</h2>
<form action="../actions/login.php" method="POST">
    <input type="email" name="email" placeholder="Email" required class="form-control">
    <input type="password" name="password" placeholder="Password" required class="form-control mt-2">
    <button type="submit" class="btn btn-primary mt-3">Login</button>
</form>
<?php include 'footer.php'; ?>

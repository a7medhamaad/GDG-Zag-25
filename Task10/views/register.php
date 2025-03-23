<?php include 'header.php'; ?>
<h2>Register</h2>
<form action="../actions/register.php" method="POST">
    <input type="text" name="name" placeholder="Name" required class="form-control">
    <input type="email" name="email" placeholder="Email" required class="form-control mt-2">
    <input type="password" name="password" placeholder="Password" required class="form-control mt-2">
    <button type="submit" class="btn btn-primary mt-3">Register</button>
</form>
<?php include 'footer.php'; ?>

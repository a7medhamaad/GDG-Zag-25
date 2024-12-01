
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <link rel="stylesheet" href="css/styel.css" /> 
    </head>
    <body>
    <div clas="wrapper">
    <nav class="navbar">
    <div class="container">
        <?php if(isset($_SESSION["userid"])) {
            echo '<a href="index.php" class="navbar-brand">My Website</a>';
            }else {
                echo 'need to login';
            }?>
        <ul class="navbar-menu">
        <?php if (isset($_SESSION["userid"])): ?>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>
        </ul>
    </div>
</nav>
  
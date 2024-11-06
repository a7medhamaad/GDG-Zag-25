<?php

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $pwd = $_POST['pwd'];
    $hashedpwd = sha1($pwd);

    require_once 'connect.php';
    require_once 'fuction.php';

    // Validate the form
    $formerror = array();

    if (empty($name)) {
        $formerror[] = 'Name cannot be <strong>empty</strong>';
    }

    if (empty($pwd)) {
        $formerror[] = 'Password cannot be <strong>empty</strong>';
    }

    // Display errors if any
    foreach ($formerror as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }

    if (empty($formerror)) {
        // Check if the user exists and the password is correct
        $stmt = $con->prepare("SELECT * FROM users WHERE Username = ? AND Password = ?");
        $stmt->execute(array($name, $hashedpwd));
        $user = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            // Successful login - start the session here
            session_start();
            $_SESSION["userid"] = $user["Uid"]; // Ensure Uid matches the actual column name in your table
            $_SESSION["username"] = $user["Username"];
            header("Location: ../profile.php"); // Redirect to profile after successful login
            exit();
        } else {
            // Invalid credentials
            $themsg = "<div class='alert alert-danger'>Invalid username or password.</div>";
            redirecthome($themsg, 'back');
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}

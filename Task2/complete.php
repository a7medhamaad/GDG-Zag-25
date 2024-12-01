<?php 
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: profile.php"); // Redirect if not logged in
    exit();
}

include_once 'header.php';
require_once 'include/connect.php';
require_once 'include/fuction.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer to ensure it's safe
    $stmt = $con->prepare("UPDATE task SET Status = '1' WHERE id = ?");
    
    if ($stmt->execute(array($id))) {
        $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() . " Task Completed</div>";
    } else {
        $themsg = "<div class='alert alert-danger'>Error completing task.</div>";
    }
    
       redirecthome($themsg, 'back');
} else {
    header("Location: ../profile.php");
    exit();
}

include_once 'footer.php';
?>
<?php 
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: profile.php"); // Redirect if already logged in
    exit();
}
include_once 'header.php';
require_once 'include/connect.php';
require_once 'include/fuction.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM task WHERE Id = ?");
    $stmt->execute(array($id));
           $themsg ="<div class='alert alert-success'>" . $stmt->rowCount() . "Task Deleted</div>";
           redirecthome($themsg,'previous');
       
       
} else {
    header("Location: ../profile.php");
    exit();
}
     
include_once 'footer.php';

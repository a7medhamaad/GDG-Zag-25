<?php

if (isset($_POST["submit"])) {
    $task = $_POST['task'];


    require_once 'connect.php';
    require_once 'fuction.php';

    // Validate the form
    $formerror = array();

    if (empty($task)) {
        $formerror[] = 'Task cannot be <strong>empty</strong>';
    }
    foreach ($formerror as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
  
    if (empty($formerror)) {
    
        // Insert into the database 
           $stmt = $con->prepare("INSERT INTO task(Task) VALUES(:ztask)");
           $stmt->execute(array(
               'ztask' => $task
           ));
           $themsg ="<div class='alert alert-success'>" . $stmt->rowCount() . "Task Added</div>";
           redirecthome($themsg, 'back',3);
   
   }
}else{
    header("location: ../profile.php");
    exit();
}
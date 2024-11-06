<?php 
if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $fullname=$_POST["fullname"];
    $pwd=sha1($_POST["pwd"]);
    $pwdagain=sha1($_POST["pwdagain"]);

    require_once 'connect.php';
    require_once 'fuction.php';
     // Validate the form
     $formerror = array();

     if (strlen($name) < 4) {
         $formerror[] = 'name must be greater than <strong>3 characters</strong>';
     }
     if (strlen($name) > 20) {
         $formerror[] = 'name must be less than <strong>20 characters</strong>';
     }
     if (strlen($fullname) < 4) {
         $formerror[] = 'fullname must be greater than <strong>3 characters</strong>';
     }
     if (strlen($fullname) > 20) {
         $formerror[] = 'fullname must be less than <strong>30 characters</strong>';
     }
     if (empty($fullname)) {
         $formerror[] = 'fullname cannot be <strong>empty</strong>';
     }
     if (empty($name)) {
         $formerror[] = 'Name cannot be <strong>empty</strong>';
     }
     if (empty($email)) {
         $formerror[] = 'Email cannot be <strong>empty</strong>';
     }
     if (empty($pwd)) {
         $formerror[] = '<pass cannot be <strong>empty</strong>';
     }
     if ($pwd !== $pwdagain) {
         $formerror[] = 'pass not <strong>match</strong>';
     }

     foreach ($formerror as $error) {
         echo '<div class="alert alert-danger">' . $error . '</div>';
     }
   
     if (empty($formerror)) {
        //check if user exit in database
         $check=checkitem("Username","users",$name); 
         if($check==1){
            $themsg ="<div class='alert alert-danger'>this user is exist.</div>";
             redirecthome($themsg,'back');//back can change to anything except null beacuse null redirect to homepage 

         }else{

            // Insert into the database 
            $stmt = $con->prepare("INSERT INTO users(Username, Email, Password,	Fullname) VALUES(:zuser, :zmail, :zpass, :zfull)");
            $stmt->execute(array(
                'zuser' => $name,
                'zmail' => $email,
                'zpass' => $pwd,
                'zfull' => $fullname,
            ));
            $themsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Inserted</div>";
            redirecthome($themsg, 'back',3);
    }
    }
    

}else{
    header("location: ../signup.php");
    exit();
}
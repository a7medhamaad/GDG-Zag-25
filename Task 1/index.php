<?php 
include_once 'header.php';
?>
<?php 
session_start();
if (!isset($_SESSION["userid"])) {
 echo 'need to login';
}else{
   echo '<h2>Home Page</h2>';
}
?>

<!-- <h3>Nothing To Show</h3> -->
<!-- <h2>Home Page</h2> -->

<?php 
include_once 'footer.php';
?>

<!-- $$$$$$$$$$$$$$$$$ -->
<?php
session_start();
include 'header.php';
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit();
}

$sessionusername = $_SESSION["username"];
require_once 'include/connect.php';

if(isset($_SESSION['userid'])){
    global $con;
    $getuser=$con->prepare("SELECT * FROM users WHERE Username=?");
    $getuser->execute(array ($sessionusername));
    $info=$getuser->fetch();
}
?>
 <h1 class="text-center">My Profile</h1>
    <div class="information block">
        <div class="container">
             <div class="panel panel-primary">
                <div class="panel-heading"><h3>My Information</h3></div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                       <li><span>Name</span>:<?php echo $info['Username']?></li> 
                        <li><span>Email</span>:<?php echo $info['Email']?></li> 
                        <li> <span>Full Name</span>:<?php echo $info['Fullname']?></li> 
                    </ul>
                    <div class="panel-heading"><h3>My Complete Tasks: </h3></div>
                    <ul>
                        <?php
                        require 'include/connect.php'; // Ensure this path is correct
                        $stmt = $con->prepare("SELECT * FROM task where Status=1 ");
                        $stmt->execute();
                        $tasks = $stmt->fetchAll();

                        foreach ($tasks as $task) {
                            echo "<li>" . htmlspecialchars($task['Task']) . " 
                                <a href='deletetask.php?id=" . $task['Id'] . "'>Delete</a>
                            </li>";
                        }
                        ?>
                    </ul>
                    <hr>
                    <div class="panel-heading"><h3>Not Complete Tasks: </h3></div>
                    <ul>
                        <?php
                        require 'include/connect.php'; // Ensure this path is correct
                        $stmt = $con->prepare("SELECT * FROM task where Status=0 ");
                        $stmt->execute();
                        $tasks = $stmt->fetchAll();
                        foreach ($tasks as $task) {
                            echo "<li>" . htmlspecialchars($task['Task']) . " 
                                <a href='complete.php?id=" . $task['Id'] . "'>Complete</a>
                                <a href='deletetask.php?id=" . $task['Id'] . "'>Delete</a>
                            </li>";
                        }
                        ?>
                    </ul>
                    <a href="uploadtask.php"><h4>Add Task</h4></a>
                </div>
             </div>
        </div>
        <hr>
    </div>



<?php include 'footer.php'; ?>
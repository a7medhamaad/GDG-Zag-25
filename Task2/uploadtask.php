<?php 
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php"); // Redirect if not login 
    exit();
}
include_once 'header.php';
?>
<div class="login-form">
    <h1>To-Do List</h1>
        <form action="include/uploadtask.inc.php" method="post">
            <input type="text" name="task" placeholder="Enter a new task" required>
            <button type="submit" name="submit">Add Task</button>
        </form>
</div>

<?php 
include_once 'footer.php';
?>
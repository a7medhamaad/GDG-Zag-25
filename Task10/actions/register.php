<?php
include '../config/database.php';
include '../classes/User.php';
$database = new Database();
$pdo = $database->connect();
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($name, $email, $password)) {
        header("Location: ../views/login.php");
    } else {
        echo "Registration failed!";
    }
}

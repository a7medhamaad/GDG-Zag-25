<?php
include '../config/database.php';
include '../classes/User.php';
$database = new Database();
$pdo = $database->connect();
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->login($email, $password)) {
        header("Location: ../public/index.php");
    } else {
        echo "Invalid credentials!";
    }
}

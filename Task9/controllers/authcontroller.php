<?php
session_start();
require_once '../config/database.php';
require_once '../classes/User.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->register($name, $email, $password)) {
            header("Location: ../views/login.php?message=Registration successful");
            exit();
        } else {
            header("Location: ../views/register.php?error=Registration failed");
            exit();
        }
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->login($email, $password)) {
            header("Location: ../views/dashboard.php");
            exit();
        } else {
            header("Location: ../views/login.php?error=Invalid credentials");
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    $user->logout();
}

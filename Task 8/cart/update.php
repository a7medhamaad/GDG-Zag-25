<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] = $quantity;
}

header('Location: index.php');
exit;
?>
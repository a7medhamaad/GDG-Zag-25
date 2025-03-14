<?php
session_start();
require_once '../config/database.php';
require_once '../classes/Product.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

$product = new Product();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);

    if (!empty($name) && !empty($description) && $price > 0) {
        if ($product->createProduct($name, $description, $price)) {
            header("Location: ../views/products.php?message=Product added successfully");
        } else {
            header("Location: ../views/products.php?error=Failed to add product");
        }
    } else {
        header("Location: ../views/products.php?error=Invalid product details");
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $userId = $_SESSION['user_id'];

    if ($id > 0) {
        $ownerId = $product->getProductOwner($id);

        if ($ownerId == $userId) {
            if ($product->updateProduct($id, $name, $description, $price)) {
                header("Location: ../views/products.php?message=Product updated successfully");
            } else {
                header("Location: ../views/products.php?error=Failed to update product");
            }
        } else {
            header("Location: ../views/products.php?error=You are not authorized to update this product");
        }
    } else {
        header("Location: ../views/products.php?error=Invalid product ID");
    }
    exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $userId = $_SESSION['user_id'];
    if ($id > 0) {
        $ownerId = $product->getProductOwner($id);

        if ($ownerId == $userId) {
            if ($product->deleteProduct($id)) {
                header("Location: ../views/products.php?message=Product deleted successfully");
            } else {
                header("Location: ../views/products.php?error=Failed to delete product");
            }
        } else {
            header("Location: ../views/products.php?error=You are not authorized to delete this product");
        }
    } else {
        header("Location: ../views/products.php?error=Invalid product ID");
    }
    exit();
}

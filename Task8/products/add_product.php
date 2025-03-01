<?php
include '../includes/db.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (empty($name) || empty($description) || empty($price)) {
        $error = "All fields are required!";
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = "Price must be a valid number greater than 0!";
    } else {

        $stmt = $pdo->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
        $stmt->execute([$name, $description, $price]);
        header('Location: ../index.php');
        exit;
    }
}
?>

<div class="container">
    <h1>Add Product</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" class="form-container">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" placeholder="Product Name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" placeholder="Product Description" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" placeholder="Price" required>
        </div>
        <button type="submit" class="btn">Add Product</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
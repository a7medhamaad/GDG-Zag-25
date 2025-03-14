<?php
include '../views/header.php';
require_once '../config/database.php';
require_once '../classes/Product.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$product = new Product();
$products = $product->getProducts();
?>

<div class="container mt-4">
    <h2>Manage Products</h2>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success"><?php echo $_GET['message']; ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
    <?php endif; ?>

    <form action="../controllers/productController.php" method="POST" class="mb-4">
        <input type="text" name="name" class="form-control mb-2" placeholder="Product Name" required>
        <textarea name="description" class="form-control mb-2" placeholder="Product Description" required></textarea>
        <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price" required>
        <button type="submit" name="create" class="btn btn-success">Add Product</button>
    </form>

        <?php if (!$products): ?>

        <?php else: ?>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $prod): ?>
            <tr>
                <td><?php echo htmlspecialchars($prod['name']); ?></td>
                <td><?php echo htmlspecialchars($prod['description']); ?></td>
                <td>$<?php echo htmlspecialchars($prod['price']); ?></td>
                <td>
                    <form action="../controllers/productController.php" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                        <input type="text" name="name" value="<?php echo $prod['name']; ?>" required>
                        <input type="text" name="description" value="<?php echo $prod['description']; ?>" required>
                        <input type="number" step="0.01" name="price" value="<?php echo $prod['price']; ?>" required>
                        <button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>
                    </form>
                    <a href="../controllers/productController.php?delete=<?php echo $prod['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif ?>
</div>



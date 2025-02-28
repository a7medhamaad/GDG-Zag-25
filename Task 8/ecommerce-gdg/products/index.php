<?php
include '../includes/db.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<?php include '../includes/header.php'; ?>
<div class="container">
    <h1>Products</h1>
    <!-- Add Product Button -->
    <div class="text-center mb-20">
        <a href="add_product.php" class="btn">Add Product</a>
    </div>
    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product-item">
                <h2><?= $product['name'] ?></h2>
                <p><?= $product['description'] ?></p>
                <p>Price: $<?= $product['price'] ?></p>
                <a href="view.php?id=<?= $product['id'] ?>">View Product</a>
                <form action="../cart/add.php" method="POST" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<?php
include '../includes/header.php';
include '../includes/db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$product_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found!";
    exit;
}
?>

<h1><?= $product['name'] ?></h1>
<p><?= $product['description'] ?></p>
<p>Price: $<?= $product['price'] ?></p>
<form action="../cart/add.php" method="POST">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit">Add to Cart</button>
</form>
<a href="../products/index.php">Back to Products</a>

<?php include '../includes/footer.php'; ?>
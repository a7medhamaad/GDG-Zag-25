<?php
// session_start();
include '../includes/header.php';
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$products = [];

foreach ($cart as $product_id => $quantity) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
    if ($product) {
        $products[] = $product;
    }
}
?>

<h1>Your Cart</h1>
<?php if (empty($products)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <?php foreach ($products as $product): ?>
        <div>
            <h2><?= $product['name'] ?></h2>
            <p>Price: $<?= $product['price'] ?></p>
            <p>Quantity: <?= $cart[$product['id']] ?></p>
            <form action="update.php" method="POST" style="display:inline;">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="number" name="quantity" value="<?= $cart[$product['id']] ?>" min="1">
                <button type="submit">Update</button>
            </form>
            <a href="remove.php?id=<?= $product['id'] ?>" >Remove</a>
            <a href="checkout.php?id=<?= $product['id'] ?>" >Checkout</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<a href="../products/index.php">Continue Shopping</a>

<?php include '../includes/footer.php'; ?>
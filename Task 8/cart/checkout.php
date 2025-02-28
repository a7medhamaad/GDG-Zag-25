<?php
include '../includes/header.php';
include '../includes/db.php';

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

// Fetch cart items from session
$cart = $_SESSION['cart'] ?? [];
$products = [];
$total = 0;

// Calculate total and fetch product details
foreach ($cart as $product_id => $quantity) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();

    if ($product) {
        $product['quantity'] = $quantity;
        $products[] = $product;
        $total += $product['price'] * $quantity;
    }
}

// Handle order placement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert order into the database
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $total]);
    $order_id = $pdo->lastInsertId();

    // Insert order items into the database
    foreach ($products as $product) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $product['id'], $product['quantity'], $product['price']]);
    }

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to a success page or homepage
    header('Location: ../cart/index.php');
    exit;
}
?>

<div class="container">
    <h1>Checkout</h1>
    <?php if (empty($products)): ?>
        <p>Your cart is empty. <a href="../products/index.php">Continue shopping</a></p>
    <?php else: ?>
        <div class="cart-items">
            <?php foreach ($products as $product): ?>
                <div class="cart-item">
                    <h2><?= $product['name'] ?></h2>
                    <p>Price: $<?= $product['price'] ?></p>
                    <p>Quantity: <?= $product['quantity'] ?></p>
                    <p>Subtotal: $<?= $product['price'] * $product['quantity'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="total">
            <h3>Total: $<?= $total ?></h3>
        </div>
        <form method="POST">
            <button type="submit" class="btn">Place Order</button>
        </form>
    <?php endif; ?>
</div>

<?php
include '../includes/footer.php';
?>
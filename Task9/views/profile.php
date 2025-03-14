<?php
include '../views/header.php';
require_once '../config/database.php';
require_once '../classes/User.php';
require_once '../classes/Product.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user = new User();
$userData = $user->getUserById($_SESSION['user_id']);

$product = new Product();
$userProducts = $product->getProductsByUserId($_SESSION['user_id']);
?>

<div class="card mx-auto mt-5" style="max-width: 400px;">
    <div class="card-body text-center">
        <h2 class="card-title">Profile</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($userData['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
        <a href="../views/dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>

<div class="container mt-4">
    <h3>Your Products</h3>
    <?php if (!$userProducts): ?>
        <p>You haven't added any products yet.</p>
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
                <?php foreach ($userProducts as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                        <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                    <td> <a href="../controllers/productController.php?delete=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm">Delete</a> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once "dbconnect.php";
session_start();

if (!isset($_SESSION['user']['UID'])) {
    header("Location: login.php");
    exit();
}

$UID = $_SESSION['user']['UID']; // ✅ fixed UID from session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Remove item from cart
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header("Location: cart.php");
    exit();
}

// ✅ Redirect to checkout page instead of placing order
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['checkout'])) {
    header("Location: checkout.php");
    exit();
}

// Fetch products in cart
if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $sql = "SELECT ProductID, ProductName, price FROM products WHERE ProductID IN ($ids)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $courses = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Pascal Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center mb-4">Your Cart</h1>

    <?php if (empty($courses)): ?>
        <p class="text-center">Your cart is empty. <a href="order.php">Browse courses</a></p>
    <?php else: ?>
        <form method="POST">
            <table class="table table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Course</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $grandTotal = 0;
                foreach ($courses as $course):
                    $qty = $cart[$course['ProductID']]['qty'];
                    $total = $qty * $course['price'];
                    $grandTotal += $total;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($course['ProductName']); ?></td>
                        <td>$<?= $course['price']; ?></td>
                        <td><?= $qty; ?></td>
                        <td>$<?= $total; ?></td>
                        <td><a href="?remove=<?= $course['ProductID']; ?>" class="btn btn-danger btn-sm">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-info">
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td colspan="2"><strong>$<?= $grandTotal; ?></strong></td>
                </tr>
                </tbody>
            </table>

            <div class="text-center">
                <button type="submit" name="checkout" class="btn btn-primary btn-lg">Proceed to Checkout</button>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>

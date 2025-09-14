<?php
require_once "dbconnect.php";
session_start();

if (!isset($_SESSION['UID'])) {
    header("Location: login.php");
    exit();
}

$UID = $_SESSION['UID'];

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Handle remove item
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header("Location: cart.php");
    exit();
}

// Handle order submission (Checkout)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['checkout'])) {
    if (!empty($cart)) {
        $conn->beginTransaction();
        try {
            // Insert into orders
            $orderSql = "INSERT INTO orders (userID, orderDate) VALUES (?, CURDATE())";
            $orderStmt = $conn->prepare($orderSql);
            $orderStmt->execute([$UID]);
            $orderID = $conn->lastInsertId();

            // Insert order details
            foreach ($cart as $productID => $item) {
                $qty = $item['qty'];
                $detailSql = "INSERT INTO orderdetails (orderID, productID, quantity) VALUES (?, ?, ?)";
                $detailStmt = $conn->prepare($detailSql);
                $detailStmt->execute([$orderID, $productID, $qty]);
            }

            $conn->commit();
            unset($_SESSION['cart']); // Clear cart
            header("Location: ch.php?orderID=" . $orderID);
            exit();

        } catch (Exception $e) {
            $conn->rollBack();
            echo "Checkout failed: " . $e->getMessage();
        }
    }
}

// Fetch course details for display
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
                        <td><?php echo htmlspecialchars($course['ProductName']); ?></td>
                        <td>$<?php echo $course['price']; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td>$<?php echo $total; ?></td>
                        <td><a href="?remove=<?php echo $course['ProductID']; ?>" class="btn btn-danger btn-sm">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-info">
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td colspan="2"><strong>$<?php echo $grandTotal; ?></strong></td>
                </tr>
                </tbody>
            </table>

            <div class="text-center">
                <button type="submit" name="checkout" class="btn btn-primary btn-lg">Checkout</button>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>

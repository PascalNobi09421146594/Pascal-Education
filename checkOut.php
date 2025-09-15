<?php
require_once "dbconnect.php";
session_start();

if (!isset($_SESSION['user']['UID'])) {
    header("Location: login.php");
    exit();
}

$UID = $_SESSION['user']['UID'];
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if (empty($cart)) {
    header("Location: cart.php");
    exit();
}

// Fetch cart items again
$ids = implode(',', array_keys($cart));
$sql = "SELECT ProductID, ProductName, price FROM products WHERE ProductID IN ($ids)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle final confirmation
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['confirmOrder'])) {
    $paymentMethod = $_POST['paymentMethod'] ?? 'Unknown';

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

        // Insert into payment table
        $totalAmount = array_sum(array_map(fn($course) => $course['price'] * $cart[$course['ProductID']]['qty'], $courses));
        $paymentSql = "INSERT INTO payment (OrderID, Amount, Method, status) VALUES (?, ?, ?, 'Pending')";
        $paymentStmt = $conn->prepare($paymentSql);
        $paymentStmt->execute([$orderID, $totalAmount, $paymentMethod]);

        $conn->commit();
        unset($_SESSION['cart']);
        header("Location: paymentSuccess.php?orderID=" . $orderID);
        exit();
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Checkout failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Pascal Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="text-center mb-4">Checkout</h1>
    <form method="POST">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Course</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
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
                </tr>
            <?php endforeach; ?>
            <tr class="table-info">
                <td colspan="3"><strong>Grand Total</strong></td>
                <td><strong>$<?= $grandTotal; ?></strong></td>
            </tr>
            </tbody>
        </table>

        <!-- Payment Method Dropdown -->
        <div class="mb-3">
            <label for="paymentMethod" class="form-label fw-bold">Select Payment Method</label>
            <select class="form-select" name="paymentMethod" id="paymentMethod" required>
                <option value="" disabled selected>-- Choose Payment Method --</option>
                <option value="PayPal">PayPal</option>
                <option value="Visa Card">Visa Card</option>
                <option value="MasterCard">MasterCard</option>
                <option value="Kpay">Kpay</option>
                <option value="WavePay">WavePay</option>
                <option value="CB Pay">CB Pay</option>
                <option value="AYA Pay">AYA Pay</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" name="confirmOrder" class="btn btn-success btn-lg">
                Confirm & Place Order
            </button>
        </div>
    </form>
</div>
</body>
</html>

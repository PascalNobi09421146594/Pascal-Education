<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "dbconnect.php";

// ✅ Check if user is logged in
// if (!isset($_SESSION['UID'])) {
//     header("Location: login.php?redirect=checkout.php");
//     exit();
// }

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if (empty($cart)) {
    echo "<div class='alert alert-warning text-center mt-5'>Your cart is empty. <a href='index.php'>Go back</a></div>";
    exit();
}

// ✅ Prepare Product IDs
$productIDs = implode(",", array_keys($cart));
$sql = "SELECT ProductID, ProductName, price FROM products WHERE ProductID IN ($productIDs)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ✅ Calculate total and fix array qty issue
$total = 0;
foreach ($products as &$product) {
    $productID = $product['ProductID'];
    // ✅ Get quantity safely
    if (is_array($cart[$productID])) {
        $quantity = isset($cart[$productID]['qty']) ? $cart[$productID]['qty'] : 1;
    } else {
        $quantity = $cart[$productID];
    }
    $product['quantity'] = (int)$quantity;
    $product['subtotal'] = (float)$product['price'] * (int)$quantity;
    $total += $product['subtotal'];
}

// ✅ Handle order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    try {
        $conn->beginTransaction();

        // Insert order
        $sql = "INSERT INTO orders (userID, orderDate) VALUES (?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_SESSION['UID']]);
        $orderID = $conn->lastInsertId();

        // Insert order details
        $sql = "INSERT INTO orderdetails (orderID, productID, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        foreach ($products as $product) {
            $stmt->execute([$orderID, $product['ProductID'], $product['quantity']]);
        }

        // Insert payment
        $sql = "INSERT INTO payment (OrderID, Amount, Method) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$orderID, $total, $_POST['payment_method']]);

        $conn->commit();

        // Clear cart
        unset($_SESSION['cart']);

        header("Location: history.php?success=1");
        exit();

    } catch (Exception $e) {
        $conn->rollBack();
        echo "<div class='alert alert-danger'>Error placing order: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="mb-4 text-center">Checkout</h2>

    <!-- Order Summary -->
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Course</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['ProductName']) ?></td>
                <td><?= $product['quantity'] ?></td>
                <td><?= number_format($product['price'], 2) ?></td>
                <td><?= number_format($product['subtotal'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="table-secondary">
                <th colspan="3" class="text-end">Total:</th>
                <th><?= number_format($total, 2) ?></th>
            </tr>
        </tfoot>
    </table>

    <!-- Payment Method -->
    <form method="POST" class="bg-white p-4 shadow-sm rounded">
        <h5 class="mb-3">Choose Payment Method</h5>
        <div class="mb-3">
            <select class="form-select" name="payment_method" required>
                <option value="">-- Select Payment Method --</option>
                <option value="paypal">PayPal</option>
                <option value="visa">Visa Card</option>
                <option value="mastercard">MasterCard</option>
                <option value="kpay">KPay</option>
                <option value="wavepay">WavePay</option>
                <option value="cbpay">CB Pay</option>
                <option value="ayapay">AYA Pay</option>
            </select>
        </div>

        <button type="submit" name="place_order" class="btn btn-success btn-lg w-100">
            Confirm & Place Order
        </button>
    </form>
</div>

</body>
</html>

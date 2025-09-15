<?php
session_start();
require_once "dbconnect.php";

// // 1️⃣ Check login
if (!isset($_SESSION['user']['UID'])) {
        header("Location: login.php?redirect=history.php");
exit();
}


$user_id = $_SESSION['user']['UID'];

// 2️⃣ Fetch orders & related products
$sql = "SELECT o.orderID, o.orderDate, p.ProductName, p.price, od.quantity
        FROM orders o
        JOIN orderdetails od ON o.orderID = od.orderID
        JOIN products p ON od.productID = p.ProductID
        WHERE o.userID = ?
        ORDER BY o.orderDate DESC";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group orders by orderID
$groupedOrders = [];
foreach ($orders as $row) {
    $orderID = $row['orderID'];
    if (!isset($groupedOrders[$orderID])) {
        $groupedOrders[$orderID] = [
            'orderDate' => $row['orderDate'],
            'items' => [],
            'totalAmount' => 0
        ];
    }

    $subtotal = $row['price'] * $row['quantity'];
    $groupedOrders[$orderID]['items'][] = [
        'productName' => $row['ProductName'],
        'quantity' => $row['quantity'],
        'price' => $row['price'],
        'subtotal' => $subtotal
    ];
    $groupedOrders[$orderID]['totalAmount'] += $subtotal;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php require_once "Reusable_php/nav.php"; ?>

    <div class="container my-5">
        <h2 class="mb-4">📜 Your Order History</h2>

        <?php if (empty($groupedOrders)): ?>
            <div class="alert alert-info">You have no previous orders.</div>
        <?php else: ?>
            <?php foreach ($groupedOrders as $orderID => $order): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Order #<?php echo $orderID; ?></h5>
                        <p class="text-muted">Date: <?php echo $order['orderDate']; ?></p>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Course</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['items'] as $item): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['productName']); ?></td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                                        <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <h6 class="text-end">Total: <strong>$<?php echo number_format($order['totalAmount'], 2); ?></strong></h6>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php require_once "Reusable_php/footer.php"; ?>
</body>
</html>

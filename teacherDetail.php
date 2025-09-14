<?php
require_once "dbconnect.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION['UID'])) {
    header("Location: login.php");
    exit();
}

$UID = $_SESSION['UID'];

// Fetch all available courses (products)
$sql = "SELECT p.ProductID, p.ProductName, p.price, p.description, c.catName 
        FROM products p
        JOIN category c ON p.category = c.catID";
$stmt = $conn->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle order submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course'])) {
    $conn->beginTransaction();
    try {
        // Insert into orders table
        $orderSql = "INSERT INTO orders (userID, orderDate) VALUES (?, CURDATE())";
        $orderStmt = $conn->prepare($orderSql);
        $orderStmt->execute([$UID]);
        $orderID = $conn->lastInsertId();

        // Insert selected courses into orderdetails table
        foreach ($_POST['course'] as $productID) {
            $qty = isset($_POST['qty'][$productID]) ? (int)$_POST['qty'][$productID] : 1;
            $detailSql = "INSERT INTO orderdetails (orderID, productID, quantity) VALUES (?, ?, ?)";
            $detailStmt = $conn->prepare($detailSql);
            $detailStmt->execute([$orderID, $productID, $qty]);
        }

        $conn->commit();
        header("Location: order_success.php?orderID=" . $orderID);
        exit();

    } catch (Exception $e) {
        $conn->rollBack();
        echo "Order failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Courses - Pascal Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Order Courses</h1>

        <form method="POST">
            <div class="row">
                <?php foreach ($courses as $course): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($course['ProductName']); ?></h5>
                                <p class="text-muted"><?php echo htmlspecialchars($course['catName']); ?></p>
                                <p><?php echo htmlspecialchars($course['description']); ?></p>
                                <p><strong>Price:</strong> $<?php echo $course['price']; ?></p>

                                <input type="checkbox" name="course[]" value="<?php echo $course['ProductID']; ?>">
                                Select
                                <input type="number" name="qty[<?php echo $course['ProductID']; ?>]" value="1" min="1" class="form-control mt-2">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
            </div>
        </form>
    </div>
</body>
</html>

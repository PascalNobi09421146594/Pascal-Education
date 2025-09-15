<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login.php");
    exit();
}

require_once "../dbconnect.php";

// --- Stats ---
$totalUsers = $conn->query("SELECT COUNT(*) FROM user WHERE role='user'")->fetchColumn();
$totalProducts = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalOrders = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$totalRevenue = $conn->query("SELECT IFNULL(SUM(Amount),0) FROM payment WHERE status='Paid'")->fetchColumn();

// --- Tutors ---
$tutors = $conn->query("SELECT t.TID, t.name, t.subject, t.education, t.imgPath, c.catName as category
                        FROM tutor t JOIN category c ON t.category = c.catID")->fetchAll(PDO::FETCH_ASSOC);

// --- Payments ---
$payments = $conn->query("SELECT p.PID, p.OrderID, p.Amount, p.Method, p.status,
                                 o.orderDate, u.username, u.email
                          FROM payment p
                          JOIN orders o ON p.OrderID = o.orderID
                          JOIN user u ON o.userID = u.UID
                          ORDER BY p.PID DESC")->fetchAll(PDO::FETCH_ASSOC);

// --- Orders ---
$orders = $conn->query("SELECT o.orderID, o.orderDate, u.username, u.email, p.productName, od.quantity, p.price
                        FROM orders o
                        JOIN user u ON o.userID = u.UID
                        JOIN orderdetails od ON o.orderID = od.orderID
                        JOIN products p ON od.productID = p.productID
                        ORDER BY o.orderID DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Pascal Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #212529, #343a40);
        }

        .sidebar h3 {
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .nav-link {
            font-size: 1.1rem;
            margin: 5px 0;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .card h4 {
            font-weight: bold;
            margin: 0;
        }

        .card i {
            font-size: 1.8rem;
            margin-bottom: 8px;
            color: #495057;
        }

        .tutor-card {
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            margin: 5px;
            padding: 10px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar text-white p-3">
                <h3><i class="fa-solid fa-chalkboard"></i> Admin</h3>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="dashboard.php" class="nav-link text-white"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="productManagement.php" class="nav-link text-white "><i class="fa-solid fa-box"></i> Products</a></li>
                    <li class="nav-item"><a href="paymentManagement.php" class="nav-link text-white"><i class="fa-solid fa-receipt"></i> Payment</a></li>
                    <li class="nav-item"><a href="OrderView.php" class="nav-link text-white active"><i class="fa-solid fa-shopping-cart"></i> Orders</a></li>
                    <li class="nav-item"><a href="tutorManagement.php" class="nav-link text-white"><i class="fa-solid fa-person-chalkboard"></i> Tutor</a></li>
                    <li class="nav-item"><a href="roleManagement.php" class="nav-link text-white"><i class="fa-solid fa-users"></i> Users</a></li>
                    <br>
                    <li class="nav-item"><a href="../LogOut.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>

                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 p-4">


                <!-- Orders -->
                <section id="orders" class="mt-5">
                    <h3>📦 Orders</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Order ID</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $o):
                                    $subtotal = $o['price'] * $o['quantity'];
                                ?>
                                    <tr>
                                        <td><?= $o['orderID'] ?></td>
                                        <td><?= htmlspecialchars($o['username']) ?></td>
                                        <td><?= htmlspecialchars($o['email']) ?></td>
                                        <td><?= htmlspecialchars($o['productName']) ?></td>
                                        <td><?= $o['quantity'] ?></td>
                                        <td>$<?= number_format($o['price'], 2) ?></td>
                                        <td>$<?= number_format($subtotal, 2) ?></td>
                                        <td><?= $o['orderDate'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>

</html>
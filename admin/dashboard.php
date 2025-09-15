<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login.php");
    exit();
}

require_once "../dbconnect.php";

// Fetch statistics
$totalUsers = $conn->query("SELECT COUNT(*) FROM user WHERE role='user'")->fetchColumn();
$totalProducts = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalOrders = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
// Uncomment this when you have total column in orders table
$totalRevenue = $conn->query("SELECT IFNULL(SUM(Amount),0) FROM payment WHERE status='paid'")->fetchColumn();

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
        body { background-color: #f8f9fa; }
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
            background: rgba(255,255,255,0.1);
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
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar text-white p-3">
            <h3><i class="fa-solid fa-chalkboard"></i> Admin</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white active"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li class="nav-item"><a href="productManagement.php" class="nav-link text-white"><i class="fa-solid fa-box"></i> Products</a></li>
                <li class="nav-item"><a href="paymentManagement.php" class="nav-link text-white"><i class="fa-solid fa-receipt"></i> Payment</a></li>
                <li class="nav-item"><a href="OrderView.php" class="nav-link text-white"><i class="fa-solid fa-shopping-cart"></i> Orders</a></li>
                <li class="nav-item"><a href="tutorManagement.php" class="nav-link text-white"><i class="fa-solid fa-person-chalkboard"></i> Tutor</a></li>
                <li class="nav-item"><a href="roleManagement.php" class="nav-link text-white"><i class="fa-solid fa-users"></i> Users</a></li>
                <br>
                <li class="nav-item"><a href="../LogOut.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 p-4">
            <h2 class="mb-4 fw-bold"><i class="fa-solid fa-gauge-high"></i> Dashboard Overview</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <i class="fa-solid fa-user-graduate"></i>
                        <h4><?= $totalUsers ?></h4>
                        <p class="mb-0 text-secondary">Users</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <i class="fa-solid fa-book"></i>
                        <h4><?= $totalProducts ?></h4>
                        <p class="mb-0 text-secondary">Products</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <h4><?= $totalOrders ?></h4>
                        <p class="mb-0 text-secondary">Orders</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <h4>$<?= number_format($totalRevenue, 2) ?></h4>
                        <p class="mb-0 text-secondary">Total Revenue</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>

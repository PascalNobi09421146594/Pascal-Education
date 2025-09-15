<?php
require_once "../dbconnect.php";
session_start();

// ✅ Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login.php");
    exit();
}

// ✅ Handle status update
if (isset($_POST['updateStatus'])) {
    $paymentID = $_POST['paymentID'];
    $newStatus = $_POST['status'];

    $sql = "UPDATE payment SET status = ? WHERE PID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$newStatus, $paymentID]);

    header("Location: paymentManagement.php?success=1");
    exit();
}

// ✅ Fetch payment records with order + user info
$sql = "
SELECT p.PID, p.OrderID, p.Amount, p.Method, p.status,
       o.orderDate, u.username, u.email
FROM payment p
JOIN orders o ON p.OrderID = o.orderID
JOIN user u ON o.userID = u.UID
ORDER BY p.PID DESC
";
$stmt = $conn->prepare($sql);
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Payment Management</title>
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
        .nav-link:hover,
        .nav-link.active {
            background: rgba(255,255,255,0.1);
        }
    </style>
</head>

<body class="bg-light">

<div class="container-fluid">
    <div class="row">
         <nav class="col-md-2 sidebar text-white p-3">
            <h3><i class="fa-solid fa-chalkboard"></i> Admin</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li class="nav-item"><a href="productManagement.php" class="nav-link text-white "><i class="fa-solid fa-box"></i> Products</a></li>
                <li class="nav-item"><a href="paymentManagement.php" class="nav-link text-white active"><i class="fa-solid fa-receipt"></i> Payment</a></li>
                <li class="nav-item"><a href="OrderView.php" class="nav-link text-white"><i class="fa-solid fa-shopping-cart"></i> Orders</a></li>
                <li class="nav-item"><a href="tutorManagement.php" class="nav-link text-white"><i class="fa-solid fa-person-chalkboard"></i> Tutor</a></li>
                <li class="nav-item"><a href="roleManagement.php" class="nav-link text-white"><i class="fa-solid fa-users"></i> Users</a></li>
                <br>
                <li class="nav-item"><a href="../LogOut.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </nav>

        <!-- ✅ Main Dashboard Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4 text-center">💳 Payment Management</h2>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success text-center">✅ Payment status updated successfully!</div>
            <?php endif; ?>

            <div class="table-responsive shadow p-3 bg-white rounded">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>PID</th>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($payments) > 0): ?>
                            <?php foreach ($payments as $p): ?>
                            <tr>
                                <td><?= $p['PID']; ?></td>
                                <td>#<?= $p['OrderID']; ?></td>
                                <td><?= htmlspecialchars($p['username']); ?></td>
                                <td><?= htmlspecialchars($p['email']); ?></td>
                                <td>$<?= number_format($p['Amount'], 2); ?></td>
                                <td><?= htmlspecialchars($p['Method']); ?></td>
                                <td>
                                    <?php
                                        $badgeClass = match ($p['status']) {
                                            'Paid' => 'success',
                                            'Failed' => 'danger',
                                            default => 'warning',
                                        };
                                    ?>
                                    <span class="badge bg-<?= $badgeClass ?>"><?= $p['status']; ?></span>
                                </td>
                                <td><?= $p['orderDate']; ?></td>
                                <td>
                                    <form method="POST" class="d-flex gap-2">
                                        <input type="hidden" name="paymentID" value="<?= $p['PID']; ?>">
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="Pending" <?= $p['status']=='Pending'?'selected':''; ?>>Pending</option>
                                            <option value="Paid" <?= $p['status']=='Paid'?'selected':''; ?>>Paid</option>
                                            <option value="Failed" <?= $p['status']=='Failed'?'selected':''; ?>>Failed</option>
                                        </select>
                                        <button type="submit" name="updateStatus" class="btn btn-primary btn-sm">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No payments found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>

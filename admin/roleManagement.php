<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login.php");
    exit();
}
require_once("../dbconnect.php");

// Fetch all users
try {
    $sql = "SELECT UID, username, email, role FROM user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}

// Handle role change
if (isset($_GET['uid']) && isset($_GET['role'])) {
    $uid = intval($_GET['uid']);
    $newRole = ($_GET['role'] === 'admin') ? 'admin' : 'user';

    try {
        $sql = "UPDATE user SET role = ? WHERE UID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$newRole, $uid]);

        $_SESSION['message'] = "User role updated successfully!";
        header("Location: roleManagement.php");
        exit();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management | Admin Dashboard</title>
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
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar text-white p-3">
            <h3><i class="fa-solid fa-chalkboard"></i> Admin</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li class="nav-item"><a href="productManagement.php" class="nav-link text-white"><i class="fa-solid fa-box"></i> Products</a></li>
                <li class="nav-item"><a href="paymentManagement.php" class="nav-link text-white"><i class="fa-solid fa-receipt"></i> Payment</a></li>
                <li class="nav-item"><a href="OrderView.php" class="nav-link text-white"><i class="fa-solid fa-shopping-cart"></i> Orders</a></li>
                <li class="nav-item"><a href="tutorManagement.php" class="nav-link text-white"><i class="fa-solid fa-person-chalkboard"></i> Tutor</a></li>
                <li class="nav-item"><a href="roleManagement.php" class="nav-link text-white active"><i class="fa-solid fa-users"></i> Users</a></li>
                <br>
                <li class="nav-item"><a href="../LogOut.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 p-4">
            <h2 class="mb-4 fw-bold"><i class="fa-solid fa-user-gear"></i> User Management</h2>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success"><?= $_SESSION['message']; ?></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <table class="table table-bordered table-striped text-center shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Current Role</th>
                        <th>Change Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['username']); ?></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                            <td><?= htmlspecialchars($user['role']); ?></td>
                            <td>
                                <?php if ($user['role'] === 'admin'): ?>
                                    <a href="?uid=<?= $user['UID']; ?>&role=user" class="btn btn-warning btn-sm">Change to User</a>
                                <?php else: ?>
                                    <a href="?uid=<?= $user['UID']; ?>&role=admin" class="btn btn-success btn-sm">Change to Admin</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>
</body>
</html>

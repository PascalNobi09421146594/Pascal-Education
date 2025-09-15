<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login.php");
    exit();
}

require_once "../dbconnect.php";

// Fetch tutors
$sql = "SELECT t.TID, t.name, t.subject, t.education, c.catName, t.imgPath 
        FROM tutor t 
        JOIN category c ON t.category = c.catID";
$stmt = $conn->prepare($sql);
$stmt->execute();
$tutors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Management</title>
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

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>

</head>

<body class="bg-light">

<div class="container-fluid">
     <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar text-white p-3">
            <h3><i class="fa-solid fa-chalkboard"></i> Admin</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li class="nav-item"><a href="productManagement.php" class="nav-link text-white"><i class="fa-solid fa-box"></i> Products</a></li>
                <li class="nav-item"><a href="paymentManagement.php" class="nav-link text-white "><i class="fa-solid fa-receipt"></i> Payment</a></li>
                <li class="nav-item"><a href="OrderView.php" class="nav-link text-white"><i class="fa-solid fa-shopping-cart"></i> Orders</a></li>
                <li class="nav-item"><a href="tutorManagement.php" class="nav-link text-white active"><i class="fa-solid fa-person-chalkboard"></i> Tutor</a></li>
                <li class="nav-item"><a href="roleManagement.php" class="nav-link text-white"><i class="fa-solid fa-users"></i> Users</a></li>
                <br>
                <li class="nav-item"><a href="../LogOut.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </nav>

        <div class="col-md-10 p-4">
            <h2 class="mb-4 text-center"><i class="fa-solid fa-chalkboard-user"></i> Tutor View</h2>

            <div class="text-end mb-3">
                <a href="addTutor.php" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add Tutor</a>
            </div>

            <div class="table-responsive shadow p-3 bg-white rounded">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>TID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Education</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tutors)): ?>
                            <?php foreach ($tutors as $t): ?>
                                <tr>
                                    <td><?= $t['TID']; ?></td>
                                    <td><img src="<?= htmlspecialchars($t['imgPath']); ?>" style="width:100px; height:100px; border-radius:5px;"></td>
                                    <td><?= htmlspecialchars($t['name']); ?></td>
                                    <td><?= htmlspecialchars($t['subject']); ?></td>
                                    <td><?= htmlspecialchars($t['catName']); ?></td>
                                    <td><?= htmlspecialchars($t['education']); ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-muted">No tutors found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

</div>
       
</body>

</html>
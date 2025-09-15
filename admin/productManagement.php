<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login.php");
    exit();
}
require_once("../dbconnect.php");

try {
    $sql = "SELECT p.productID,p.productName,p.price,p.description,p.qty,p.imgPath,c.catName as category
            FROM products p, category c
            WHERE p.category = c.catID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <li class="nav-item"><a href="productManagement.php" class="nav-link text-white active"><i class="fa-solid fa-box"></i> Products</a></li>
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
            <h2 class="fw-bold mb-4"><i class="fa-solid fa-box"></i> Manage Products</h2>

            <div class="d-flex justify-content-end mb-3">
                <a href="insertProduct.php" class="btn btn-success rounded-pill">
                    <i class="fa-solid fa-plus"></i> Insert Product
                </a>
            </div>

            <?php
            if (isset($_SESSION["message"])) {
                echo "<p class='alert alert-success w-50'> $_SESSION[message] </p>";
                unset($_SESSION["message"]);
            } elseif (isset($_SESSION["deleteSuccess"])) {
                echo "<p class='alert alert-success w-50'> $_SESSION[deleteSuccess] </p>";
                unset($_SESSION["deleteSuccess"]);
            } elseif (isset($_SESSION["updateMessage"])) {
                echo "<p class='alert alert-success w-50'> $_SESSION[updateMessage] </p>";
                unset($_SESSION["updateMessage"]);
            }
            ?>

            <table class="table table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['productName']) ?></td>
                            <td><?= htmlspecialchars($product['category']) ?></td>
                            <td>$<?= $product['price'] ?></td>
                            <td><?= $product['qty'] ?></td>
                            <td class="text-wrap"><?= substr($product['description'], 0, 200) ?></td>
                            <td><img src="<?= $product['imgPath'] ?>" style="width:120px;height:120px;object-fit:cover;"></td>
                            <td>
                                <div class="btn-group">
                                    <a href="editDelete.php?eid=<?= $product['productID'] ?>" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="editDelete.php?did=<?= $product['productID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
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

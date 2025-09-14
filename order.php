<?php
session_start();
require_once "dbconnect.php";

// // Redirect if not logged in
// if (!isset($_SESSION['UID'])) {
//     header("Location: login.php");
//     exit();
// }

// Fetch all products
try {
    $sql = "SELECT p.productID, p.productName, p.price, p.description, p.qty,
                   p.imgPath, c.catName as category
            FROM products p
            JOIN category c ON p.category = c.catID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

// Handle Add to Cart
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product'])) {
    foreach ($_POST['product'] as $productID) {
        $qty = isset($_POST['qty'][$productID]) ? (int)$_POST['qty'][$productID] : 1;
        $_SESSION['cart'][$productID] = [
            'qty' => $qty
        ];
    }
    header("Location: cart.php"); // redirect to cart after adding
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pascal Education Customer Page</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffffff;
            color: #333;
        }

        header {
            background-color: #FFD43B;
            /* Classic green */
            color: white;
            padding: 20px;
            text-align: center;
        }


        .hero {
            background-color: #e8f5e9;
            padding: 40px;
            text-align: center;
        }

        .hero h1 {
            color: #2e7d32;
        }

        .courses {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .course-card {
            background-color: white;
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            margin: 10px;
            padding: 20px;
            width: 350px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .course-card:hover {
            /* background-color: #333; */
            color: #e1de3fff;
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            margin: 10px;
            padding: 20px;
            width: 350px;
            box-shadow: 0 2px 5px rgba(225, 205, 51, 1);
        }




        

       

        footer {
            background-color: #2e7d32;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
    </style>
</head>

<body>

<div class="nav"><?php require_once "Reusable_php/nav.php"; ?></div>

<header>
    <h1>Explore Available IGCSE Courses</h1>
    <p>Empower your future with curated learning experiences</p>
</header>

<form method="POST">
<section class="courses">
    <?php if (!empty($products)) : ?>
        <?php foreach ($products as $product): ?>
            <div class="course-card">
                <img src="../admin/<?php echo htmlspecialchars($product['imgPath']); ?>"
                     alt="<?php echo htmlspecialchars($product['productName']); ?>"
                     style="width:100%; height:150px; object-fit:cover; border-radius:5px;">

                <h3><b><?php echo htmlspecialchars($product['productName']); ?></b></h3>
                <p><b>Category:</b> <?php echo htmlspecialchars($product['category']); ?></p>
                <p><b>Price:</b> $<?php echo number_format($product['price'], 2); ?></p>
                <p><b>Qty available:</b> <?php echo htmlspecialchars($product['qty']); ?></p>

                <input type="checkbox" name="product[]" value="<?php echo $product['productID']; ?>"> Select
                <input type="number" name="qty[<?php echo $product['productID']; ?>]" value="1" min="1" max="<?php echo $product['qty']; ?>" class="form-control mt-1">
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</section>

<div class="text-center mt-3">
    <button type="submit" class="btn btn-success btn-lg">Add Selected Courses to Cart</button>
</div>
</form>

<div class="footer"><?php require_once "Reusable_php/footer.php"; ?></div>
</body>
</html>
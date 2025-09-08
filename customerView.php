<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once "dbconnect.php";
try {
    $sql = "SELECT  p.productID, p.productName, 
		p.price, p.description, p.qty,
        p.imgPath, c.catName as category
        from products p, category c 
        where p.category = c.catID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(); // just naming variable for multiple products

} catch (PDOException $e) {
    echo $e->getMessage();
}

try {
    $sql = "select * from category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}


//for category search 
if (isset($_GET['cSearch']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $cid = $_GET['category'];

    try {
        $sql = "SELECT p.productID,p.productName,p.price,p.description,p.qty,p.imgPath,c.catName as category
            from products p,category c where p.category = c.catID
            and c.catID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$cid]);
        $products = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


//for radiosearch

elseif (isset($_POST['radioBtn'])) {
    $price = $_POST['price'];
    if ($price == "first") {
        $lower = 200;
        $upper = 300;
    } else if ($price == 'second') {
        $lower = 301;
        $upper = 500;
    } else if ($price = 'third') {
        $lower = 501;
        $upper = 800;
    }

    try {

        $sql = "select p.productID, p.productName,
                p.price, p.description, p.qty, p.imgPath, c.catName 

                from products p,category c
                where p.price BETWEEN ? and ?  and c.catID = p.category";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$lower, $upper]);
        $products   = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pascal Education Customer Page</title>
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

    <div class="nav">
        <?php require_once "Reusable_php/nav.php" ?>
    </div>

    <header>
        <h1>Explore Available IGCSE Courses</h1>
        <p>Empower your future with curated learning experiences</p>
    </header>



    <section class="courses">
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product): ?>
                <div class="course-card">
                    <img src="../admin/<?php echo htmlspecialchars($product['imgPath']); ?>"

                        alt="<?php echo htmlspecialchars($product['productName']); ?>"

                        style="width:100%; height:150px; object-fit:cover; border-radius:5px;">

                        <br>
                        <br>

                    <h3><b><?php echo htmlspecialchars($product['productName']); ?></b></h3>
                    <p><b>Category:</b> <?php echo htmlspecialchars($product['category']); ?></p>
                    <p><b>Price:</b> $<?php echo number_format($product['price'], 2); ?></p>

                    <!-- <p> <?php //echo htmlspecialchars($product['description']); ?></p> -->

                    <p><b>Qty:</b> <?php echo htmlspecialchars($product['qty']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </section>

    <div class="footer">
        <?php require_once "Reusable_php/footer.php" ?>

    </div>

</body>

</html>
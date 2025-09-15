<?php
require_once "../dbconnect.php";

if (!isset($_SESSION)) {
    session_start();
}

// Fetch categories
try {
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}

// Fetch product for editing
if (isset($_GET["eid"])) {
    $productID = $_GET["eid"];
    try {
        $sql = "SELECT p.productID, p.productName, c.catName, p.category,
                p.price, p.description, p.qty, p.imgPath
                FROM products p, category c
                WHERE p.category=c.catID AND p.productID = ?";
        $statement = $conn->prepare($sql);
        $statement->execute([$productID]);
        $product = $statement->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// Delete product
elseif (isset($_GET["did"])) {
    try {
        $productID = $_GET["did"];
        $sql = "DELETE FROM products WHERE productID = ?";
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute([$productID]);
        if ($status) {
            $_SESSION["deleteSuccess"] = "Product ID $productID has been deleted successfully.";
            header("Location: productManagement.php");
            exit;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
// Update product
elseif (isset($_POST['updatebtn'])) {
    $productName = $_POST['pname'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['desc'];
    $qty = $_POST['qty'];
    $fileImg = $_FILES['productImage'];

    $filePath = "productImage/$fileImg[name]";
    $status = move_uploaded_file($fileImg['tmp_name'], $filePath);

    if ($status) {
        try {
            $pid = $_POST['pid'];
            $sql = "UPDATE products 
                    SET productName=?, category=?, price=?, qty=?, description=?, imgPath=? 
                    WHERE productID=?";
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute([$productName, $category, $price, $qty, $description, $filePath, $pid]);

            if ($status) {
                $_SESSION['updateMessage'] = "Product ID $pid has been updated successfully.";
                header("Location: viewProduct.php");
                exit;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <?php require_once "../Reusable_php/nav.php"; ?>

        <div class="card shadow-sm p-4 my-4">
            <h4 class="mb-3">Edit Product</h4>

            <?php if (!isset($product)) { ?>
                <div class="alert alert-warning">No product selected. Please go back to the product list.</div>
                <a href="viewProduct.php" class="btn btn-secondary">Back to Products</a>
            <?php } else { ?>

            <form action="editDelete.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="pid" value="<?php echo $product['productID']; ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="pname" class="form-control" value="<?php echo $product['productName']; ?>">

                        <?php if (!empty($product['catName'])) { ?>
                            <p class="alert alert-info mt-3 p-2">Previous Category: <?php echo $product['catName']; ?></p>
                        <?php } ?>

                        <label class="form-label mt-2">Select Category</label>
                        <select name="category" class="form-select">
                            <?php foreach ($categories as $cat) {
                                echo "<option value='{$cat['catID']}'> {$cat['catName']} </option>";
                            } ?>
                        </select>

                        <label class="form-label mt-2">Price</label>
                        <input type="number" name="price" class="form-control" value="<?php echo $product['price']; ?>">

                        <label class="form-label mt-2">Quantity</label>
                        <input type="number" name="qty" class="form-control" value="<?php echo $product['qty']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Description</label>
                        <textarea name="desc" class="form-control" rows="6"><?php echo $product['description']; ?></textarea>

                        <?php if (!empty($product['imgPath'])) { ?>
                            <div class="mt-3">
                                <img src="<?php echo $product['imgPath']; ?>" alt="Product Image" class="img-thumbnail" style="max-width:120px;">
                            </div>
                        <?php } ?>

                        <label class="form-label mt-2">Change Image</label>
                        <input type="file" name="productImage" class="form-control mt-1">
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" name="updatebtn" class="btn btn-primary">Update Product</button>
                    <a href="viewProduct.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            <?php } ?>
        </div>
    </div>
</body>

</html>

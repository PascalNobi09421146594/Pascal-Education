<?php
require_once "../dbconnect.php";
if (!isset($_SESSION)) {
    session_start();
}

try {
    $sql = "select * from category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}

if (isset($_POST["insertBtn"])) {
    $name = $_POST["pname"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $qty = $_POST["qty"];
    $description = $_POST["description"];
    $fileImage = $_FILES["productImage"];

    $filePath = "productImage/" . $fileImage["name"];

    $status = move_uploaded_file($fileImage["tmp_name"], $filePath);

    echo $status;

    if ($status) {
        try { //inserting data into database
            //productID	productName	category	price	description	qty	imgPath	
            
            $sql = "insert into products values (?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $flag = $stmt->execute([null, $name, $category, $price, $description, $qty, $filePath]);

            $id = $conn->lastInsertId();
            if ($flag) {
                $message = "new product with id $id has been insered successfully!.";
                $_SESSION['message'] = $message;
                header("Location: ../customerView.php");
            } else {
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo "file upload failed";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <?php require_once "../Reusable_php/nav.php" ?>
        </div>

        <!-- Only this part is redesigned -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4 mb-4">
                    <div class="card-body p-5 ">
                        <h3 class="text-center mb-4 fw-bold">Insert Subject</h3>

                        <form class="form" action="insertProduct.php" method="post" enctype="multipart/form-data">
                            <div class="row g-4">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pname" class="form-label fw-semibold">Subject Name</label>
                                        <input type="text" class="form-control form-control-lg rounded-3" name="pname">
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label fw-semibold">Price</label>
                                        <input type="number" class="form-control form-control-lg rounded-3" name="price">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Category</label>
                                        <select name="category" class="form-select form-select-lg rounded-3">
                                            <option value="" >Choose Category</option>
                                            <?php
                                            if (isset($categories)) {
                                                foreach ($categories as $category) {
                                                    echo "<option value=$category[catID]> $category[catName]</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Quantity</label>
                                        <input type="number" class="form-control form-control-lg rounded-3" name="qty">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Description</label>
                                        <textarea name="description" class="form-control form-control-lg rounded-3" rows="4"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Choose Textbook Image</label>
                                        <input type="file" class="form-control form-control-lg rounded-3" name="productImage">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" name="insertBtn" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
                                    <b>INSERT</b>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <?php require_once "../Reusable_php/footer.php" ?>

    </div>
</body>


</html>
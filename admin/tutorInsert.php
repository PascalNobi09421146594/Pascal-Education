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
    $subject = $_POST["subject"];
    $category = $_POST["category"];
    $education = $_POST["education"];
    $description = $_POST["description"];
    $fileImage = $_FILES["productImage"];

    $filePath = "teacherImage/" . $fileImage["name"];

    $status = move_uploaded_file($fileImage["tmp_name"], $filePath);

    echo $status;

    if ($status) {
        try { //inserting data into database
            //productID	productName	category	price	description	qty	imgPath	

            $sql = "insert into tutor values (?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $flag = $stmt->execute([null, $name, $subject, $category, $education, $description, $filePath]);

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
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <!-- Navigation -->
        <div class="row">
            <?php require_once "../Reusable_php/nav.php" ?>
        </div>

        <!-- Main Content -->
        <div class="row flex-grow-1 justify-content-center align-items-center py-5">
            <div class="col-lg-8 col-xl-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <!-- Title -->
                        <h2 class="text-center fw-bold mb-4 text-success">
                            <i class="fa-solid fa-chalkboard-user me-2"></i>Insert Teacher
                        </h2>

                        <!-- Form -->
                        <form action="tutorInsert.php" method="post" enctype="multipart/form-data">
                            <div class="row g-4">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3 shadow-sm" id="pname" name="pname" placeholder="Teacher Name" required>
                                        <label for="pname" class="fw-semibold">Teacher Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3 shadow-sm" id="subject" name="subject" placeholder="Teaching Subject" required>
                                        <label for="subject" class="fw-semibold">Teaching Subject</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category" class="form-label fw-semibold">Category</label>
                                        <select name="category" id="category" class="form-select form-select-lg rounded-3 shadow-sm" required>
                                            <option value="">Choose Category</option>
                                            <?php
                                            if (isset($categories)) {
                                                foreach ($categories as $category) {
                                                    echo "<option value='$category[catID]'>$category[catName]</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-3 shadow-sm" id="education" name="education" placeholder="Education Background">
                                        <label for="education" class="fw-semibold">Education Background</label>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control rounded-3 shadow-sm" id="description" name="description" style="height: 150px" placeholder="Write a short description"></textarea>
                                        <label for="description" class="fw-semibold">Description</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productImage" class="form-label fw-semibold">Insert Teacher Image</label>
                                        <input type="file" class="form-control form-control-lg rounded-3 shadow-sm" id="productImage" name="productImage" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" name="insertBtn" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm hover-scale">
                                    <i class="fa-solid fa-plus me-2"></i><b>INSERT</b>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-auto">
            <?php require_once "../Reusable_php/footer.php" ?>
        </div>
    </div>

    <!-- Small CSS Enhancement -->
    <style>
        .hover-scale {
            transition: transform 0.2s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
</body>



</html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "dbconnect.php";

try {
    // Fetch tutors with category names
    $sql = "SELECT t.TID, t.name, t.subject, t.education, t.description, t.imgPath, c.catName as category
            FROM tutor t
            JOIN category c ON t.category = c.catID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tutors = $stmt->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}

try {
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}

// Category search
if (isset($_GET['cSearch']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $cid = $_GET['category'];
    try {
        $sql = "SELECT t.TID, t.name, t.subject, t.education, t.description, t.imgPath, c.catName as category
                FROM tutor t
                JOIN category c ON t.category = c.catID
                WHERE c.catID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cid]);
        $tutors = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pascal Education Tutors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffffff;
            color: #333;
        }
        header {
            background-color: #FFD43B;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .hero {
            background-color: #e8f5e9;
            padding: 40px;
            text-align: center;
        }
        .tutor-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .tutor-card {
            background-color: white;
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            margin: 10px;
            padding: 20px;
            width: 350px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .tutor-card:hover {
            box-shadow: 0 4px 12px rgba(225, 205, 51, 0.8);
            transform: scale(1.02);
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
        <h1>Meet Our Tutors</h1>
        <p>Learn from experienced and passionate educators</p>
    </header>

    <section class="tutor-cards">
        <?php if (!empty($tutors)) : ?>
            <?php foreach ($tutors as $tutor): ?>
                <div class="tutor-card">
                    <img src="../admin/<?php echo htmlspecialchars($tutor['imgPath']); ?>"
                         alt="<?php echo htmlspecialchars($tutor['name']); ?>"
                         style="width:100%; height:200px; object-fit:cover; border-radius:5px;">

                    <h3 class="mt-3"><b><?php echo htmlspecialchars($tutor['name']); ?></b></h3>
                    <p><b>Subject:</b> <?php echo htmlspecialchars($tutor['subject']); ?></p>
                    <p><b>Category:</b> <?php echo htmlspecialchars($tutor['category']); ?></p>
                    <p><b>Education:</b> <?php echo htmlspecialchars($tutor['education']); ?></p>
                    <p class="text-muted small"><?php echo htmlspecialchars($tutor['description']); ?></p>

                    <a href="#" class="btn btn-success btn-sm mt-2">
                        <i class="fa-solid fa-chalkboard-user"></i> Learn More
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tutors available.</p>
        <?php endif; ?>
    </section>

    <div class="footer">
        <?php require_once "Reusable_php/footer.php" ?>
    </div>
</body>
</html>

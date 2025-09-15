<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Pascal Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f9f9f9;">

    <?php include "Reusable_php/nav.php"; ?>

    <div class="container my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">About Pascal Education</h1>
            <p class="text-muted fs-5">Empowering students with knowledge, confidence, and skills for the future.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 p-4">
                    <div class="card-body">
                        <h3 class="fw-bold mb-3">Who We Are</h3>
                        <p>
                            At <strong>Pascal Education</strong>, we are passionate about making learning accessible, engaging, and effective. 
                            Our platform connects students with experienced tutors who specialize in various subjects, ensuring every learner gets 
                            the support they need to succeed.
                        </p>

                        <h3 class="fw-bold mt-4 mb-3">Our Mission</h3>
                        <p>
                            Our mission is simple — to help students unlock their potential. We focus on building strong foundations, 
                            encouraging critical thinking, and boosting confidence so students are prepared for school exams, 
                            higher education, and beyond.
                        </p>

                        <h3 class="fw-bold mt-4 mb-3">Why Choose Us</h3>
                        <ul>
                            <li>✔ Experienced and passionate tutors</li>
                            <li>✔ Flexible online learning that fits your schedule</li>
                            <li>✔ Affordable, transparent pricing</li>
                            <li>✔ Personalized learning approach for every student</li>
                        </ul>

                        <h3 class="fw-bold mt-4 mb-3">Our Vision</h3>
                        <p>
                            We believe that education is the key to a better future. Our vision is to create a platform where every 
                            student, no matter where they are, has the opportunity to learn, grow, and achieve their dreams.
                        </p>

                        <div class="text-center mt-4">
                            <a href="order.php" class="btn btn-primary btn-lg">Start Learning Today</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "Reusable_php/footer.php"; ?>

</body>

</html>

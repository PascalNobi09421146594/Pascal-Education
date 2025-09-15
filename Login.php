<?php
session_start();
require_once "dbconnect.php";

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Fetch user (admin or regular)
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Check role
        if ($user['role'] === 'admin') {
            $_SESSION['admin'] = [
                'UID' => $user['UID'],
                'username' => $user['username'],
                'email' => $user['email']
            ];
            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            $_SESSION['user'] = [
                'UID' => $user['UID'],
                'username' => $user['username'],
                'email' => $user['email']
            ];
            header("Location: index.php"); // Redirect regular users to order page
            exit();
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Pascal Education</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
::placeholder { color: gray; font-size: 14px; }
</style>
</head>
<body>
<section class="vh-100" style="background-color: #faf5f6;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card shadow" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="../Picture/Login.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;">
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img width="50px" height="50px" src="../Picture/Logo3.png">
                                        <span class="h4 fw-bold mb-0">Welcome Back!</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">
                                        Sign into your account
                                    </h5>

                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                                    <?php endif; ?>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email address</label>
                                        <input type="email" id="email" name="email" placeholder="Email address..." class="form-control form-control-lg" required />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" placeholder="Password..." class="form-control form-control-lg" required />
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg w-100" type="submit">
                                            <i class="fa-solid fa-right-to-bracket"></i> Login
                                        </button>
                                    </div>

                                    <a class="small text-muted" href="#">Forgot password?</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">
                                        Don't have an account? 
                                        <a href="../SignUP.php" style="color: #393f81;">Register here</a>
                                    </p>
                                    <a href="#" class="small text-muted">Terms of use</a>
                                    <a href="#" class="small text-muted ms-3">Privacy policy</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

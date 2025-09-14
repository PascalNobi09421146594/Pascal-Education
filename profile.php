<?php
// Example: Load user data from database
// Replace with your database connection & query
$user = [
    "name" => "John Doe",
    "email" => "johndoe@email.com",
    "phone" => "+66 987654321",
    "grade" => "IGCSE Year 10",
    "subjects" => "Math, Physics, Chemistry",
    "avatar" => "https://via.placeholder.com/120"
];

// Example: Booked sessions (You can fetch from DB)
$sessions = [
    ["subject" => "Math", "date" => "2025-09-15", "time" => "4:00 PM", "status" => "Confirmed"],
    ["subject" => "Physics", "date" => "2025-09-17", "time" => "5:30 PM", "status" => "Pending"]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Profile - Pascal Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .profile-card {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #0d6efd;
        }
    </style>
</head>

<body>
    <div class="nav">
        <?php require_once "Reusable_php/nav.php" ?>
    </div>


    <div class="profile-card">
        <div class="text-center mb-4">
            <img src="<?= $user['avatar'] ?>" alt="Profile Picture" class="profile-avatar">
            <h3 class="mt-3 text-primary"><?= $user['name'] ?></h3>
            <p class="text-muted"><?= $user['email'] ?></p>
            <a href="edit_profile.php" class="btn btn-outline-primary btn-sm">Edit Profile</a>
        </div>

        <!-- Profile Info -->
        <h5 class="mb-3">Profile Information</h5>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Grade:</strong> <?= $user['grade'] ?></li>
            <li class="list-group-item"><strong>Subjects:</strong> <?= $user['subjects'] ?></li>
            <li class="list-group-item"><strong>Phone:</strong> <?= $user['phone'] ?></li>
        </ul>

        <!-- Booked Sessions -->
        <h5 class="mb-3">Booked Tutoring Sessions</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sessions as $session): ?>
                    <tr>
                        <td><?= $session['subject'] ?></td>
                        <td><?= $session['date'] ?></td>
                        <td><?= $session['time'] ?></td>
                        <td>
                            <?php if ($session['status'] === "Confirmed"): ?>
                                <span class="badge bg-success">Confirmed</span>
                            <?php elseif ($session['status'] === "Pending"): ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= $session['status'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">

        <?php require_once "Reusable_php/footer.php" ?>
        <p class="mb-0">&copy; 2025 Pascal Education | Secure Checkout</p>
    </footer>

</body>

</html>
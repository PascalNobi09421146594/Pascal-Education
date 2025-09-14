<?php
// Example: Fetched users from database
$users = [
  ["id" => 1, "name" => "John Doe", "email" => "john@email.com", "role" => "User"],
  ["id" => 2, "name" => "Mary Smith", "email" => "mary@email.com", "role" => "Admin"],
  ["id" => 3, "name" => "Alex Lee", "email" => "alex@email.com", "role" => "User"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Role Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .role-container {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .role-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #dee2e6;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      background: #fff;
    }
    .user-info {
      flex: 1;
      min-width: 200px;
    }
    .role-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .badge {
      font-size: 0.85rem;
    }
  </style>
</head>
<body>

<div class="role-container">
  <h3 class="mb-4 text-primary">Role Management</h3>

  <?php foreach ($users as $user): ?>
  <div class="role-card">
    <div class="user-info">
      <h6 class="mb-1"><?= $user['name'] ?> <span class="text-muted">(#<?= $user['id'] ?>)</span></h6>
      <p class="mb-1 text-muted"><?= $user['email'] ?></p>
      <span class="badge <?= $user['role']=="Admin" ? "bg-danger" : "bg-secondary" ?>">
        <?= $user['role'] ?>
      </span>
    </div>

    <div class="role-actions">
      <form method="POST" action="update_role.php" class="d-flex gap-2">
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
        <select name="role" class="form-select form-select-sm">
          <option value="User" <?= $user['role']=="User" ? "selected" : "" ?>>User</option>
          <option value="Admin" <?= $user['role']=="Admin" ? "selected" : "" ?>>Admin</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary">Update</button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>

</div>

</body>
</html>

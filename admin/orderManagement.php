<?php
// Example: Fetch orders from database
$orders = [
  ["id" => 1001, "student" => "John Doe", "email" => "johndoe@email.com", "subject" => "Math", "date" => "2025-09-15", "amount" => 50, "status" => "Paid"],
  ["id" => 1002, "student" => "Mary Smith", "email" => "mary@email.com", "subject" => "Physics", "date" => "2025-09-17", "amount" => 50, "status" => "Pending"],
  ["id" => 1003, "student" => "Alex Lee", "email" => "alex@email.com", "subject" => "Chemistry", "date" => "2025-09-18", "amount" => 50, "status" => "Failed"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Order Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .order-container {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .order-card {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #dee2e6;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      background: #fff;
    }
    .order-info {
      flex: 1;
      min-width: 200px;
    }
    .order-actions {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 10px;
    }
    .badge {
      font-size: 0.85rem;
    }
  </style>
</head>
<body>

<div class="order-container">
  <h3 class="mb-4 text-primary">Order Management</h3>

  <?php foreach ($orders as $order): ?>
  <div class="order-card">
    <div class="order-info">
      <h6 class="mb-1"><strong>#<?= $order['id'] ?></strong> - <?= $order['student'] ?></h6>
      <p class="mb-1 text-muted"><?= $order['email'] ?></p>
      <p class="mb-0"><strong>Subject:</strong> <?= $order['subject'] ?> | <strong>Date:</strong> <?= $order['date'] ?> | <strong>Amount:</strong> $<?= number_format($order['amount'], 2) ?></p>
    </div>

    <div class="order-actions">
      <?php if ($order['status'] === "Paid"): ?>
        <span class="badge bg-success">Paid</span>
      <?php elseif ($order['status'] === "Pending"): ?>
        <span class="badge bg-warning text-dark">Pending</span>
      <?php else: ?>
        <span class="badge bg-danger">Failed</span>
      <?php endif; ?>

      <form method="POST" action="update_order.php" class="d-flex gap-2">
        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
        <select name="status" class="form-select form-select-sm">
          <option value="Paid" <?= $order['status']=="Paid" ? "selected" : "" ?>>Paid</option>
          <option value="Pending" <?= $order['status']=="Pending" ? "selected" : "" ?>>Pending</option>
          <option value="Failed" <?= $order['status']=="Failed" ? "selected" : "" ?>>Failed</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary">Update</button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>

</div>

</body>
</html>

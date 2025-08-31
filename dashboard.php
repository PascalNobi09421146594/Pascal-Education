<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>eCommerce Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      min-height: 100vh;
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      color: white;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 sidebar d-none d-md-block">
        <h4 class="p-3">ShopAdmin</h4>
        <a href="#">Dashboard</a>
        <a href="#">Orders</a>
        <a href="#">Products</a>
        <a href="#">Customers</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
      </nav>

      <!-- Main Content -->
      <main class="col-md-10 ms-sm-auto px-4">
        <!-- Navbar -->
        <nav class="navbar navbar-light bg-light mt-3 mb-4">
          <div class="container-fluid">
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" />
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
            <div>
              <span class="me-3">Hello, Admin</span>
              <button class="btn btn-outline-secondary">Logout</button>
            </div>
          </div>
        </nav>

        <!-- Dashboard Cards -->
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card text-white bg-primary">
              <div class="card-body">
                <h5 class="card-title">Total Sales</h5>
                <p class="card-text">$12,340</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-success">
              <div class="card-body">
                <h5 class="card-title">Orders</h5>
                <p class="card-text">1,245</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-warning">
              <div class="card-body">
                <h5 class="card-title">Revenue</h5>
                <p class="card-text">$8,760</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="mt-5">
          <h4>Recent Orders</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1001</td>
                <td>John Doe</td>
                <td>2025-08-28</td>
                <td><span class="badge bg-success">Completed</span></td>
                <td>$120.00</td>
              </tr>
              <tr>
                <td>1002</td>
                <td>Jane Smith</td>
                <td>2025-08-28</td>
                <td><span class="badge bg-warning">Pending</span></td>
                <td>$85.00</td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>


</html>

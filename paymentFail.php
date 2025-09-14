<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment Failed - Pascal Education</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #fdecea; }
    .fail-box {
      max-width: 450px;
      margin: auto;
      margin-top: 60px;
      text-align: center;
      padding: 30px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="fail-box">
  <div class="text-danger display-3 mb-3">&#10007;</div>
  <h3 class="text-danger">Payment Failed</h3>
  <p class="text-muted">Unfortunately, your payment could not be processed. Please try again.</p>
  <a href="payment.html" class="btn btn-danger w-100 mt-3">Retry Payment</a>
</div>

</body>
</html>

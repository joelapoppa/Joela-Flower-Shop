<?php
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order Confirmed</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/styles.css">
  <style>
.thank-you-message {
    max-width: 600px;
    margin: 80px auto;
    padding: 40px;
    background-color: #f1fdf4;
    border: 2px solid #c3e6cb;
    border-radius: 12px;
    text-align: center;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
}

.thank-you-message h1 {
    color: #155724;
    margin-bottom: 20px;
    font-size: 2rem;
}

.thank-you-message p {
    color: #333;
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.thank-you-message a {
    display: inline-block;
    padding: 12px 25px;
    background-color: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.thank-you-message a:hover {
    background-color: #218838;
}
</style>

</head>
<body>
  <div class="thank-you-message">
    <h1>Thank You for Your Order!</h1>
    <p>Your order number is: <strong>#<?php echo $order_id; ?></strong></p>
    <a href="index.php">Continue Shopping</a>
  </div>
</body>
</html>

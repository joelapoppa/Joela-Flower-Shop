<?php
include "dbconfig.php";

 // Include your database connection file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
    $cart = json_decode($_POST['cart'], true);
    var_dump($cart);
} else {
    header("Location: cart.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
.checkout-container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
    font-family: 'Segoe UI', sans-serif;
}

.checkout-container h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.checkout-container label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #555;
}

.checkout-container input[type="text"],
.checkout-container input[type="email"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-top: 5px;
    font-size: 1rem;
}

.checkout-container .checkout-btn {
    background-color: #ff9fb2;
    color: white;
    padding: 12px 20px;
    border: none;
    margin-top: 25px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 6px;
    width: 100%;
    transition: background-color 0.3s ease;
}

.checkout-container .checkout-btn:hover {
    background-color:rgb(239, 127, 150);
}
</style>

</head>
<?php include "singleProdHeader.php"; ?>
<body>
  <div class="checkout-container">
    <h2>Checkout</h2>
    <form action="saveOrder.php" method="POST">
      <label for="name">Full Name:</label>
      <input type="text" name="name" required>

      <label for="address">Address:</label>
      <input type="text" name="address" required>

      <label for="email">Email:</label>
      <input type="email" name="email" required>

      <input type="hidden" name="cart" value='<?php echo htmlspecialchars(json_encode($cart), ENT_QUOTES, 'UTF-8'); ?>'>

      <button type="submit" class="checkout-btn">Place Order</button>
    </form>
  </div>

  <?php include "footer.php"; ?>
</body>
</html>

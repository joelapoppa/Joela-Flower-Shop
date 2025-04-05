<?php
include 'dbconfig.php';
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
                            $cart_product_id = intval($_POST['product_id']);
                            $cart_quantity = intval($_POST['quantity']);

                            // Fetch product details from the database
                            $cart_query = "SELECT product_name, price FROM products WHERE id = ?";
                            $cart_stmt = $conn->prepare($cart_query);
                            $cart_stmt->bind_param("i", $cart_product_id);
                            $cart_stmt->execute();
                            $cart_result = $cart_stmt->get_result();
                            $cart_product = $cart_result->fetch_assoc();

                            if ($cart_product) {
                                $product_name = $cart_product['product_name'];
                                $price = $cart_product['price'];

                                // Insert product into the cart table
                                $insert_query = "INSERT INTO cart (product_name, quantity, price) VALUES (?, ?, ?)";
                                $insert_stmt = $conn->prepare($insert_query);
                                $insert_stmt->bind_param("sid", $product_name, $cart_quantity, $price);
                                $insert_stmt->execute();
                                header("Location: " . $_SERVER['PHP_SELF']);
                                exit;

                            } else {
                                echo '<p class="error-message">Failed to add product to cart.</p>';
                            }
                        }

                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_from_cart'])) {
                            $id = intval($_POST['delete_id']);
                        
                            $delete_query = "DELETE FROM cart WHERE id = ?";
                            $stmt = $conn->prepare($delete_query);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                        
                            // Redirect to avoid form resubmission issues
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit;
                        }
                        $conn->close();
                        ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style.css">
    <script
      src="https://kit.fontawesome.com/c0d22eba7c.js"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
</head>
<body>
  <?php include 'singleProdHeader.php'; ?>
    <div class="cart-container">
        <h1 class="cart-title">Your Shopping Cart</h1>
        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'lulet_rjl');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch cart data from the database
        $cart = [];
        $sql = "SELECT * FROM cart";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cart[] = [
                    'product_name' => $row['product_name'],
                    'quantity' => 1,
                    'price' => $row['price'],
                    'id' => $row['id']
                ];
            }
        }

        if (!empty($cart)) {
            echo '<table class="cart-table">';
            echo '<thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead>';
            echo '<tbody>';
            $totalPrice = 0;
            foreach ($cart as $product) {
                $productTotal = $product['price'] * $product['quantity'];
                $totalPrice += $productTotal;
                echo '<tr>';
                echo '<td>' . htmlspecialchars($product['product_name']) . '</td>';
                echo '<td>' . $product['quantity'] . '</td>';
                echo '<td>$' . number_format($product['price'], 2) . '</td>';
                echo '<td>$' . number_format($productTotal, 2) . '</td>';
            
                // Add delete button
                echo '<td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="delete_id" value="' . htmlspecialchars($product['id']) . '">
                            <button type="submit" name="delete_from_cart" class="checkout-btn" style="background-color:#dc3545;">Delete</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '<div class="cart-summary">';
            echo '<p class="cart-total">Total: $' . number_format($totalPrice, 2) . '</p>';
            echo '<form action="checkout.php" method="POST">';
            echo '<input type="hidden" name="cart" value="' . json_encode($cart) . '">';
            echo '<button type="submit" class="checkout-btn">Proceed to Checkout</button>';
            echo '</form>';
            echo '</div>';
        } else {
            echo '<p class="empty-cart">Your cart is empty. <a href="../php/index.php" class="continue-shopping-link">Continue shopping</a>.</p>';
        }

        $conn->close();
        ?>
    </div>

    <style>
        .cart-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .cart-table tr:hover {
            background-color: #f1f1f1;
        }

        .cart-summary {
            text-align: right;
        }

        .cart-total {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .checkout-btn {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .checkout-btn:hover {
            background-color: #218838;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
        }

        .continue-shopping-link {
            color: #007bff;
            text-decoration: none;
        }

        .continue-shopping-link:hover {
            text-decoration: underline;
        }
    </style>
  <?php include 'footer.php'; ?>
</body>
</html>
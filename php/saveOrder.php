<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
     //
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $cart = json_decode($_POST['cart'], true);
var_dump($cart); 
    // Start a transaction
    $conn->begin_transaction();

    try {
        // Insert order
        $order_query = "INSERT INTO orders (name, address, email, order_date) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($order_query);
        $stmt->bind_param("sss", $name, $address, $email);
        $stmt->execute();
        $order_id = $stmt->insert_id;        

        // Insert order items
        $item_query = "INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_query);

        foreach ($cart as $item) {
            $product_name = $item['product_name'];
            $quantity = $item['quantity'];
            $price = $item['price'];

            $item_stmt->bind_param("isid", $order_id, $product_name, $quantity, $price);
            if (!$item_stmt->execute()) {
                throw new Exception("Error inserting order item: " . $item_stmt->error);
            }
        }

        // Commit transaction
        $conn->commit();

        // Optional: Clear cart table
        $conn->query("DELETE FROM cart");

        // Redirect to thank-you page
        header("Location: thankyou.php?order_id=" . $order_id);
        exit;
        
    } catch (Exception $e) {
        // Rollback transaction if anything goes wrong
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

    
?>
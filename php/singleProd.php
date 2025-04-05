<?php
// Include database connection
include 'dbconfig.php';

// Fetch product ID from query string
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details from the database
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// If product not found, redirect to home
if (!$product) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Joela Flower Shop</title>
    <link rel="stylesheet" href="../css/main.css">
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

    <main class="single-product">
    
            <div class="product-details">
                <div class="product-image">
                    <img src="../images/<?php echo htmlspecialchars($product['photo']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                </div>
                <div class="product-info">
                    <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
                    <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                    <p class="description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    <form action="cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" readonly>
                        <button type="submit" class="primary">Add to Cart</button>
                    </form>
                </div>
            </div>

    </main>

    <section class="product">
    <h2 class="product-category">Flowers you might also like...</h2>
      <button class="pre-btn"><img src="../images/arrow.png" alt="" /></button>
      <button class="nxt-btn"><img src="../images/arrow.png" alt="" /></button>
            <div class="product-container">
                <?php
                $related_query = "SELECT * FROM products WHERE id != ? ORDER BY RAND() LIMIT 4";
                $related_stmt = $conn->prepare($related_query);
                $related_stmt->bind_param("i", $product_id);
                $related_stmt->execute();
                $related_result = $related_stmt->get_result();

                while ($row = $related_result->fetch_assoc()) {
                    ?>
                    <div class="product-card">
          <div class="product-image">
            <span class="discount-tag">50% off</span>
            <img src="../images/<?php echo $row['photo']; ?>" class="product-thumb" alt="" />
            <a href="singleProd.php?id=<?php echo $row['id']; ?>">
              <button type="submit" class="card-btn">View More</button>
            </a>
          </div>
          <div class="product-info">
            <h2 class="product-brand"><?php echo $row['product_name']; ?></h2>
            <p class="product-short-description">
            <?php echo $row['description']; ?>
            </p>
            <span class="price">$<?php echo $row['price']; ?></span>
          </div>
        </div>
                    <?php
                }
                ?>
            </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
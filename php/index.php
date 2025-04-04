<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>La Botanique</title>
    <script
      src="https://kit.fontawesome.com/c0d22eba7c.js"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <?php include "dbconfig.php";?>
    <!-- header secion starts -->
    <?php include "header.php";?>

    <section id="hero-banner">
      <div class="overlay"></div>
      <div class="slogan">
        <h1>La Botanique,</h1>
        <h2>Bringing Joy in Every Bloom</h2>
      </div>
      <button class="primary">Shop Now!</button>
    </section>

    <section class="about" id="about">
      <h1 class="heading"><span> About </span> Us</h1>

      <div class="content">
        <h3>Why choose us?</h3>
        <div class="content-box">
          <img
            src="../images/labotanique-removebg-preview.png"
            alt=""
            class="sideimage"
          />
          <p>
            <strong>La Botanique: Where blooms come to life.</strong> At La
            Botanique, we believe that flowers are more than just plants. They
            are expressions of beauty, love, and joy. We are passionate about
            creating stunning floral arrangements that will make your heart
            sing.
          </p>
        </div>
        <div class="content-box">
          <p>
            Our team of expert florists is dedicated to sourcing the freshest,
            most beautiful blooms from around the world. We use our creativity
            and artistry to design unique arrangements that are sure to impress.
          </p>
          <img src="../images/OR_HERO_Florist.jpg" alt="" class="sideimage" />
        </div>
      </div>
      <button class="primary">Learn More</button>
    </section>
    <div id="products"></div>
    <section class="product">
      <h2 class="product-category">Our Flowers</h2>
      <button class="pre-btn"><img src="../images/arrow.png" alt="" /></button>
      <button class="nxt-btn"><img src="../images/arrow.png" alt="" /></button>
      <div class="product-container">
      <?php 
          $sql = "SELECT * FROM products";
          $result = $conn->query($sql);

            if($result->num_rows > 0){
              while($row=$result->fetch_assoc()){ ?>
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
      }
?>
      </div>
    </section>

    <section class="section__container" id="review">
      <h2>Testimonials</h2>
      <h1>What our customers say</h1>
      <div class="section__grid">
        <div class="section__card">
          <span><i class="ri-double-quotes-l"></i></span>
          <h4>Best Floweeeeers!!!</h4>
          <p>
            Absolutely stunning arrangements! I ordered a bouquet for my mom’s
            birthday, and she was in awe of how fresh and vibrant the flowers
            were. The team even added a personal touch with a handwritten note
            that made it extra special. Exceptional service and attention to
            detail – I’ll definitely be back!
          </p>
          <img src="../images/user-1.jpg" alt="user" />
          <h5>Allan Collins</h5>
          <h6>Client</h6>
        </div>
        <div class="section__card">
          <span><i class="ri-double-quotes-l"></i></span>
          <h4>Excellent Compositions</h4>
          <p>
            This flower shop exceeded my expectations in every way! I needed a
            last-minute arrangement for an anniversary surprise, and they
            delivered a breathtaking bouquet right on time. The flowers lasted
            over a week, and the fragrance was heavenly. Highly recommend!
          </p>
          <img src="../images/user-2.jpg" alt="user" />
          <h5>Tanya Grant</h5>
          <h6>Client</h6>
        </div>
        <div class="section__card">
          <span><i class="ri-double-quotes-l"></i></span>
          <h4>Efficient and Reliable</h4>
          <p>
            I’ve never seen such creative floral designs! I ordered centerpieces
            for my wedding, and they were truly the highlight of the décor. The
            staff was so helpful in understanding my vision and bringing it to
            life. Thank you for making my big day even more beautiful!
          </p>
          <img src="../images/user-3.jpg" alt="user" />
          <h5>Clay Washington</h5>
          <h6>Client</h6>
        </div>
      </div>
    </section>

   <?php include "footer.php";?>

    <script src="../js/script.js"></script>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "inc/head.inc.php"; ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
</head>

<body>
  <?php include "inc/nav.inc.php"; ?>

  <main class="container">
    <!-- Product Section -->
    <section id="products">
      <div class="row">
        <div class="col-md-6">
          <div class="product_img">
            <img src="images/flash_deals/silver_laptop.jpeg" alt="Silver Laptop" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="product_content">
            <h2 class="product_titled">Silver Laptop</h2>
            <p class="product_description">This laptop is perfect for everyday use. It has a 15.6-inch display, 8GB RAM, and 256GB SSD. It is powered by an Intel Core i5 processor and has a battery life of up to 10 hours. The laptop is lightweight and portable, making it ideal for students and professionals on the go.</p>
            <br>
            <br>
            <div class="price">
              <h3 class="normal_price">$799.99</h3>
            </div>
            <br>
            <div>
              <h5 class="genre">Electronics</h5>
              <h5 class="release_date">2023-08-08</h5>
            </div>
            <br>
            <div>
              <button class="btn_submit" type="button">
                <div class="rubik-bold"> Add to Cart </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Reviews Section -->
    <section class="product_reviews">
      <h3>Reviews</h3>

      <?php
      // Fetch reviews from the database or API
      $reviews = [
        [
          'name' => 'John Doe',
          'comment' => 'This laptop is amazing! It is fast, lightweight, and has a great battery life. I use it for work and it has been a great investment.',
          'rating' => 5
        ],
        [
          'name' => 'Jane Smith',
          'comment' => 'I bought this laptop for my daughter for school and she loves it. It is easy to use and has all the features she needs for her classes.',
          'rating' => 4
        ]
      ];

      // Display each review
      foreach ($reviews as $review) {
        echo '<div class="review">';
        echo '<h4>' . $review['name'] . '</h4>';
        echo '<div class="rating">';
        for ($i = 0; $i < $review['rating']; $i++) {
          echo '<i class="fas fa-star"></i>';
        }
        echo '<p>' . $review['comment'] . '</p>';
        echo '</div>';
        echo '</div>';
      }
      ?>

      <div class="review_form">
        <h3>Add a Review</h3>
        <form action="add-review.php" method="post" id="add-review" class="form-horizontal">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" class="form-control" rows="3" required></textarea>
          </div>
          <div class="star-rating mb-3">
            <label for="rating">Rating:</label>
            <input type="hidden" name="rating" id="rating-value" value="0">
            <span class="d-block text-secondary">
              <i class="fas fa-star" data-rating='5'></i>
            </span>
            <span class="d-block text-secondary">
              <i class="fas fa-star" data-rating='4'></i>
            </span>
            <span class="d-block text-secondary">
              <i class="fas fa-star" data-rating='3'></i>
            </span>
            <span class="d-block text-secondary">
              <i class="fas fa-star" data-rating='2'></i>
            </span>
            <span class="d-block text-secondary">
              <i class="fas fa-star" data-rating='1'></i>
            </span>
          </div>
          <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
      </div>
    </section>
  </main>

  <div class="push"></div>

  <?php include "inc/footer.inc.php"; ?>
</body>

</html>
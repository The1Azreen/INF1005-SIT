<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session
$productId = isset($_GET['product_id']) ? $_GET['product_id'] : null; // Get the product id from the URL

if ($productId !== null) {
  getProduct($productId); // Call the function with the product id
} else {
  echo "Product ID is not set.";
  exit;
}

function getProduct($productId)
{
  global $productName, $price, $desc, $image_path, $errorMsg, $success;

  // Create database connection.
  $config = parse_ini_file('/var/www/private/db-config.ini');
  if (!$config) {
    $errorMsg = "Failed to read database config file.";
    $success = false;
  } else {
    $conn = new mysqli(
      $config['servername'],
      $config['username'],
      $config['password'],
      $config['dbname']
    );

    // Check connection
    if ($conn->connect_error) {
      $errorMsg = "Connection failed: " . $conn->connect_error;
      $success = false;
    } else {
      $stmt = $conn->prepare("SELECT product_name, price, product_description, CONCAT('images/ProductImages/', image) AS image_path FROM products WHERE product_id = ?");
      if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
      }

      $stmt->bind_param("i", $productId);

      if (!$stmt->execute()) {
        throw new Exception("Failed to execute statement: " . $stmt->error);
      }

      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $productName = $product['product_name'];
        $price = $product['price'];
        $desc = $product['product_description'];
        $image_path = $product['image_path'];
      } else {
        echo 'This product is not available.';
      }

      $stmt->close();
      $conn->close();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $productName; ?> | CircuitCart</title>
  <?php include "inc/head.inc.php"; ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.*/dist/css/bootstrap.min.css">
  <style>
    /* Add custom styles here if needed */
  </style>
</head>

<body>
  <!-- Navigation menu inclusion -->
  <?php include "inc/nav.inc.php"; ?>

  <!-- Main Content -->
  <div class="container mt-5">
    <div class="row">
      <!-- Product Description Column -->
      <div class="col-md-6">
        <h2 class="product-title"><?php echo $productName; ?></h2>
        <p><?php echo $desc; ?></p>
        <h3 class="price">$<?php echo $price; ?></h3>
        <div class="alert alert-warning" role="alert">
          Note: A cancellation fee will apply. Cancellation fees may differ depending on your region.
        </div>
        <a href="/cart.php" class="btn btn-primary" role="button">Add to Cart</a>
      </div>

      <!-- Product Image Column -->
      <div class="col-md-6">
        <img src="<?php echo $image_path ?>" alt="<?php echo $productName ?>" class="img-fluid">
      </div>
    </div>
  </div>

  <!-- Footer section inclusion -->
  <?php include "inc/footer.inc.php"; ?>

</body>

</html>

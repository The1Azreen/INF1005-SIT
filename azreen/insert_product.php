<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Inserting Product Dashboard</title>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";

    // Establish a database connection
    $config = parse_ini_file('/var/www/private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch brand titles from the database
    $brandOptions = "";
    $sql = "SELECT brand_title FROM ShopBrandPrototypeTable";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $brandOptions .= '<option value="' . $row["brand_title"] . '">' . $row["brand_title"] . '</option>';
        }
    }
    ?>
</head>
<body class="bg-light">
  <div class="container mt-3">
    <h1 class="text-center">Insert Products</h1>
    <!-- form -->
    <form action="" method="post" enctype="multipart/form-data">
      <!-- Product Title -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_title" class="form-label">Product title</label>
        <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off">
      </div>
      <!-- Description -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="description" class="form-label">Product Description</label>
        <input type="text" name="description" id="description" class="form-control" placeholder="Enter Product Description" autocomplete="off">
      </div>
      <!-- Brands -->
      <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_brands" id="product_brands" class="form-select">
         <option value="">Select a Brand</option>
         <?php echo $brandOptions; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>

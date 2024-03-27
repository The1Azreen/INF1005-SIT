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
       // Fetch category titles from the database
       $categoryOptions = "";
       $sql = "SELECT category_title FROM ShopCategoryPrototypeTable";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
               $categoryOptions .= '<option value="' . $row["category_title"] . '">' . $row["category_title"] . '</option>';
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
     <!-- Category -->
    <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_category" id="product_category" class="form-select">
          <option value="">Select a Category</option>
          <?php echo $categoryOptions; ?>
        </select>
      </div>
      <!-- keywords -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_keywords" class="form-label">Product Keywords</label>
        <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
      </div>
      <!-- Image 1 -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image1" class="form-label">Product image 1</label>
        <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
      </div>
      <!-- Image 2 -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image2" class="form-label">Product image 2</label>
        <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
      </div>
       <!-- Image 3 -->
       <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image3" class="form-label">Product image 3</label>
        <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
      </div>


      <!-- Submit -->
      <div class="form-outline mb-4 w-50 m-auto text-center">
        <button type="submit" name="insert_product" class="btn btn-info" value="Insert Products">Insert Products</button>
      </div>

    </form>
  </div>
</body>
</html>

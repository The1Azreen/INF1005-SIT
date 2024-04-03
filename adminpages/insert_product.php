<!DOCTYPE html>
<html lang="en">

<head>
    
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>

            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>

            <!-- keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" class="form-select">
                    <option value="">Select a Category</option>
                    <?php
                    // Fetch categories from database
                    include "adminpages/inc/header.inc.php";
                    $config = parse_ini_file('/var/www/private/db-config.ini');
                    if (!$config) {
                        die("Failed to read database config file.");
                    }
                    // Establish connection to the database
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM categories";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_title'] . "</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" class="form-select">
                    <option value="">Select a Brand</option>
                    <?php
                    // Fetch brands from database
                    include "adminpages/inc/header.inc.php";
                    $config = parse_ini_file('/var/www/private/db-config.ini');
                    if (!$config) {
                        die("Failed to read database config file.");
                    }
                    // Establish connection to the database
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM brands";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_title'] . "</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>

            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>

            <!-- submit button -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
            </div>

        </form>
    </div>

</body>

</html>

<?php
// Check if the 'type' session variable is set to "true"

// Include database configuration
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish connection to the database
$con = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product details from the form
    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $product_description = $_POST['product_description'];

    // Prepare SQL statement to update product details in the database
    $stmt = $con->prepare("UPDATE products SET product_name=?, price=?, quantity=?, product_description=? WHERE product_id=?");
    $stmt->bind_param("ssisi", $product_title, $product_price, $quantity, $product_description, $product_id);

    if ($stmt->execute()) {
        // Update successful
        echo '<script>alert("Product updated successfully")</script>';
    } else {
        // Error occurred
        echo '<script>alert("Error occurred while updating product");</script>';
    }
}

// Check if product ID is provided in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // Fetch product details from the database
    $stmt = $con->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $product_title = $row['product_name'];
    $product_image = $row['filePath'];
    $product_price = $row['price'];
    $quantity = $row['quantity'];
    $product_description = $row['product_description'];
} else {
    // Redirect to products page if product ID is not provided
    header("Location: ../adminpages/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../inc/head.inc.php";
    ?>
</head>

<body>
    <section class="contact-form">
        <h3 class="text-center text-success">Edit Product</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-5">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <div class="form-group">
                <label for="product_title">Product Title</label>
                <input type="text" class="form-control" id="product_title" name="product_title"
                    value="<?php echo $product_title; ?>">
            </div>
            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="text" class="form-control" id="product_price" name="product_price"
                    value="<?php echo $product_price; ?>">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>">
            </div>
            <div class="form-group">
                <label for="product_description">Description</label>
                <textarea class="form-control" id="product_description"
                    name="product_description"><?php echo $product_description; ?></textarea>
            </div>
            <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
            <button type="submit" class="btn btn-info btn-block">Update Product</button>
        </form>
    </section>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
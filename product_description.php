<?php
session_start(); // Start the session
$productId = isset($_GET['product_id']) ? $_GET['product_id'] : null; // Get the product id from the URL
if ($productId !== null) {
    // getProduct($productId); // Call the function with the product id
    $productId = intval($_GET['product_id']);

    if ($productId <= 0) {
        // Handle the case when product_id is not a valid integer
        echo "Invalid product ID.";
    }
} else {
    echo "Product ID is not set.";
    exit;
}
function getProduct($productId)
{
    global $productName, $price, $desc, $image_path, $quantity, $errorMsg, $success;

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
            $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $conn->error);
            }
            $stmt->bind_param("i", $productId);
            if (!$stmt->bind_param("i", $productId)) {
                throw new Exception("Failed to bind parameters: " . $stmt->error);
            }
            $stmt->execute();
            if (!$stmt->execute()) {
                throw new Exception("Failed to execute statement: " . $stmt->error);
            }
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $productName = $product['product_name'];
                $price = $product['price'];
                $desc = $product['product_description'];
                $image_path = $product['filePath'];
                $quantity = $product['quantity'];
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
    <title>Dell Alienware AW3225QF | CircuitCart</title>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.*/dist/css/bootstrap.min.css">
    <style>
        /* Add custom styles here if needed */
    </style>
</head>

<body>
    <?php
    // Call the getProduct function to retrieve the product details
    getProduct($productId);
    ?>
    <!-- Navigation menu inclusion -->
    <?php include "inc/nav.inc.php"; ?>

    <!-- Main Content -->
    <div class="container mt-5" aria-label="Product details for Dell Alienware AW3225QF">
        <div class="row">
            <!-- Product Description Column -->
            <div class="col-md-6">
                <h2 class="product-title"><?php echo $productName; ?></h2>
                <p><?php echo $desc; ?></p>
                <h3 class="price">$<?php echo $price; ?></h3>
                <div class="alert alert-warning" role="alert">
                    Note: A cancellation fee will apply. Cancellation fees may differ depending on your region.
                </div>
                <?php
                // Check if quantity is greater than 0, if so, render the button
                if ($quantity > 0) {
                    echo '<button class="btn btn-primary" style="text-align: center;" onclick="addToCart(' . $productId . ', \'' . $productName . '\', ' . $price . ')">Add to Cart</button>';
                } else {
                    echo '<button class="btn btn-secondary" style="text-align: center;" disabled>Add to Cart</button>';
                }
                ?>
            </div>

            <!-- Product Image Column -->
            <div class="col-md-6">
                <img src="<?php echo $image_path ?>" alt="Image of Dell Alienware AW3225QF" class="img-fluid"
                    aria-label="Image of Dell Alienware AW3225QF">
            </div>
        </div>
    </div>
    <br>

    <!-- Footer section inclusion -->
    <?php include "inc/footer.inc.php"; ?>

    <script>
        function addToCart(productId, productName, price) {
            var formData = new FormData();
            formData.append('product_id', productId);
            formData.append('product_name', productName);
            formData.append('price', price);

            fetch('add_to_cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data); // Show response from server
                    location.reload(); // Reload the page to show updated cart
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>

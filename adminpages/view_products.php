<?php
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
?>

<aside>
    <h3 class="text-center text-success">All Products</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            // Prepared statement for selecting products
            $stmt = $con->prepare("SELECT * FROM products");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $product_id = $row['product_id'];
                $product_title = $row['product_name'];
                $product_image = $row['filePath'];
                $product_price = $row['price'];
                $quantity = $row['quantity'];
                $product_description = $row['product_description'];
                // Construct the complete image URL with the product_id parameter
                $image_url = 'http://35.209.60.37/' . $product_image . '?product_id=' . $product_id;
                ?>
                <tr class='text-center'>
                    <td>
                        <?php echo htmlspecialchars($product_id); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($product_title); ?>
                    </td>
                    <td><img src="<?php echo htmlspecialchars($image_url); ?>" alt="Product Image" width="200" height="200">
                    </td>
                    <td>$
                        <?php echo htmlspecialchars($product_price); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($quantity); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($product_description); ?>
                    </td>
                    <td><a href="edit_product.php?product_id=<?php echo $product_id; ?>" class="btn btn-default">Edit</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</aside>

<?php
// Close the database connection
$con->close();
?>

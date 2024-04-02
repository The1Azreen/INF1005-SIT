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

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Products</title>
    <!-- Include necessary CSS/JS libraries -->
    <?php include "adminpages/inc/head.inc.php"; ?>
</head>

<body>

    <main class="container">
        <h3 class="text-center text-success">All Products</h3>
        <table class="table table-bordered mt-5">
            <thead class="bg-info">
                <tr>
                    <th>Product ID</th>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="bg-secondary text-light">
                <?php
                $get_products = "SELECT * FROM `products`";
                $result = mysqli_query($con, $get_products);
                $number = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_name'];
                    $product_image = $row['filePath'];
                    $product_price = $row['price'];
                    $status = $row['status'];
                    $number++;
                ?>
                    <tr class='text-center'>
                        <td><?php echo $product_id; ?></td>
                        <td><?php echo $product_title; ?></td>
                        <td><img src="<?php echo $product_image; ?>" alt="<?php echo $product_image; ?>" width="40" height="40"></td>


                        <td>$<?php echo $product_price; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><a href='index.php?edit_products=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                        <td><a href='index.php?delete_product=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>

    <?php include "adminpages/inc/footer.inc.php"; ?>
</body>

</html>

<?php
// Close the database connection
$con->close();
?>

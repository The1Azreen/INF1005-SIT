<?php
// Start the session to access session variables
session_start();

// Check if the 'type' session variable is set to "true"
if (!isset($_SESSION['type']) || strcmp($_SESSION['type'], "true") !== 0) {
    // If not admin, redirect to main index or login page
    header('Location: /index.php');
    exit();
}

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
    <?php include "../inc/head.inc.php"; ?>
    <title>Admin Dashboard - View Products</title>
    <!-- Include additional stylesheets and scripts for the modal here if needed -->
</head>
<body>
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
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="bg-secondary text-light">
                <?php
                // Database query to select all products
                $stmt = $con->prepare("SELECT * FROM products");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_name'];
                    $product_image = $row['filePath'];
                    $product_price = $row['price'];
                    $quantity = $row['quantity'];
                    $product_description = $row['description'];
                    ?>
                    <tr class='text-center'>
                        <td><?php echo htmlspecialchars($product_id); ?></td>
                        <td><?php echo htmlspecialchars($product_title); ?></td>
                        <td><img src="<?php echo htmlspecialchars($product_image); ?>" alt="Product Image" width="200" height="200"></td>
                        <td>$<?php echo htmlspecialchars($product_price); ?></td>
                        <td><?php echo htmlspecialchars($quantity); ?></td>
                        <td><?php echo htmlspecialchars($product_description); ?></td>
                        <td>
                            <a href="edit_product.php?product_id=<?php echo $product_id; ?>" class="btn btn-default">Edit</a>
                        </td>
                        <td>
                            <button class="btn btn-danger delete-button" data-product-id="<?php echo $product_id; ?>">Delete</button>
                        </td>
                    </tr>
                    <?php
                }
                $stmt->close();
                ?>
            </tbody>
        </table>
    </aside>

    <!-- Delete Confirmation Modal -->
    <div id="confirmModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete-confirm">Yes, Delete It</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Delete Confirmation Modal -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.delete-button');
        var confirmDeleteButton = document.getElementById('delete-confirm');
        var productIDToDelete;

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                productIDToDelete = this.getAttribute('data-product-id');
                $('#confirmModal').modal('show');
            });
        });

        confirmDeleteButton.addEventListener('click', function () {
            window.location.href = 'delete_product.php?product_id=' + productIDToDelete;
        });
    });
    </script>

    <?php
    // Close the database connection
    $con->close();
    ?>
</body>
</html>

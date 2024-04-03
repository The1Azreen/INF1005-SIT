<?php
session_start(); // Start the session

function getProducts()
{
    global $productId, $productName, $price, $errorMsg, $success;
    global $products;


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
            $stmt = $conn->prepare("SELECT * FROM products");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $products[] = [
                        'product_id' => $row['product_id'],
                        'image' => $row['filePath'],
                        'name' => $row['product_name'],
                        'price' => $row['price'],
                        'description' => $row['product_description'],
                        'quantity' => $row['quantity'] // Add quantity to the product array
                    ];
                }
            } else {
                echo 'No products available.';
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
    <title>Circuit Cart Product Page</title>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.*/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
        include "inc/nav.inc.php";
    ?>
    <div class="table-responsive">
        <table class="table">
            <?php
            getProducts();
            $productCount = count($products);
            $productsPerPage = 9; // Set the number of products per page to 6
            $pageCount = ceil($productCount / $productsPerPage);

            if (isset($_GET['page'])) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }

            $startIndex = ($currentPage - 1) * $productsPerPage;
            $endIndex = $startIndex + $productsPerPage;
            $paginatedProducts = array_slice($products, $startIndex, $productsPerPage);

            echo '<div class="product-container" data-products-per-row="3">';
            echo '<table class="table">';
            foreach ($paginatedProducts as $index => $product) {
                if ($index % 3 === 0) {
                    echo '<tr>';
                }

                echo '<td>';
                echo '<div class="product-card">';
                echo '<div class="product-image" style="text-align: center; margin: 0 auto;">';
                echo '<a href="product_description.php?product_id=' . $product['product_id'] . '">';
                echo '<img src="' . $product['image'] . '" alt="' . $product['image'] . '" width="200" height="200" >';
                echo '</a>';
                echo '</div>';
                echo '<div class="product-info" style="text-align: center;">';
                echo '<h2 class="product-title">' . $product['name'] . '</h2>';
                echo '<p class="product-price">' . $product['price'] . '</p>';
                /* echo '<p class="product-description">' . $product['description'] . '</p>'; */

                // Check if quantity is greater than 0, if so, render the button
                if ($product['quantity'] > 0) {
                    echo '<button class="btn btn-primary" style="text-align: center;" onclick="addToCart(' . $product['product_id'] . ', \'' . $product['name'] . '\', ' . $product['price'] . ')">Add to Cart</button>';
                } else {
                    echo '<button class="btn btn-secondary" style="text-align: center;" disabled>Add to Cart</button>';
                }
                
                echo '</div>';
                echo '</div>';
                echo '</td>';

                if (($index + 1) % 3 === 0 || $index === $productCount - 1) {
                    echo '</tr>';
                }
            }
            echo '</table>';

            // Pagination links
            echo '<nav aria-label="Table Pagination">';
            echo '<ul class="pagination">';
            for ($page = 1; $page <= $pageCount; $page++) {
                echo '<li class="page-item' . ($currentPage == $page ? ' active' : '') . '">';
                echo '<a class="page-link" href="?page=' . $page . '">' . $page . '</a>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</nav>';
            echo '</div>';
            ?>
        </table>

    </div>
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

    <?php
    // Include footer.inc.php for the footer section
    include "inc/footer.inc.php";
    ?>

</body>

</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
session_start(); // Start the session


function getProducts($category_names = null)
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
            // Prepare and execute query
            if (is_array($category_names) && count($category_names) > 0) {
                $placeholders = implode(',', array_fill(0, count($category_names), '?'));
                $stmt = $conn->prepare("SELECT p.* FROM products p WHERE p.category IN ($placeholders)");
                $stmt->bind_param(str_repeat('s', count($category_names)), ...$category_names);
            } else {
                $stmt = $conn->prepare("SELECT * FROM products");
            }
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $products[] = [
                        'product_id' => $row['product_id'],
                        'image' => $row['filePath'],
                        'name' => $row['product_name'],
                        'price' => $row['price'],
                        'description' => $row['product_description']
                    ];
                }
            } else {
                echo 'No products available.';
            }
            $stmt->close();
            $conn->close();
        }
    }
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // If this is an AJAX request, return the products as a JSON response
        echo json_encode($products);
    } else {
        // If this is not an AJAX request, return the products array
        return $products;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php
    include "inc/nav.inc.php";
    ?>
    <div style="display: flex;">
        <div style="flex: 1;">
            <form id="filterForm" action="product.php" method="GET">

                <label for="watches">
                    <input type="checkbox" id="watches" name="category[]" value="Watches" <?php if (isset($_GET['category']) && in_array('Watches', $_GET['category'])) echo 'checked'; ?>>
                    Watches
                </label>
                <label for="laptops">
                    <input type="checkbox" id="laptops" name="category[]" value="Laptop" <?php if (isset($_GET['category']) && in_array('Laptop', $_GET['category'])) echo 'checked'; ?>>
                    Laptops
                </label>
                <label for="speakers">
                    <input type="checkbox" id="speakers" name="category[]" value="Speaker" <?php if (isset($_GET['category']) && in_array('Speaker', $_GET['category'])) echo 'checked'; ?>>
                    Speakers
                </label>
                <input type="submit" value="Filter">
            </form>
        </div>
        <div id="productTable" style="flex: 3;">
            <div class="table-responsive">
                <table class="table">
                    <?php

                    // Get products for selected categories or all products if no categories are selected
                    $category_names = isset($_GET['category']) ? $_GET['category'] : null;
                    getProducts($category_names);
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
                        echo '<img src="' . $product['image'] . '" alt="' . $product['image'] . '" width="200" height="200">';
                        echo '</a>';
                        echo '</div>';
                        echo '<div class="product-info" style="text-align: center;">';
                        echo '<h2 class="product-title">' . $product['name'] . '</h2>';
                        echo '<p class="product-price">' . $product['price'] . '</p>';
                        /* echo '<p class="product-description">' . $product['description'] . '</p>'; */

                        echo '<button class="btn btn-primary" style="text-align: center;" onclick="addToCart(' . $product['product_id'] . ', \'' . $product['name'] . '\', ' . $product['price'] . ')">Add to Cart</button>';
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
                        if (is_array($category_names) && count($category_names) > 0) {
                            echo '<a class="page-link" href="?page=' . $page . '&category[]=' . implode('&category[]=', $category_names) . '">' . $page . '</a>';
                        } else {
                            echo '<a class="page-link" href="?page=' . $page . '">' . $page . '</a>';
                        }
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</nav>';

                    // Display the link for the current page
                    echo '<p>Current Page: <a href="?page=' . $currentPage . '">' . $currentPage . '</a></p>';
                    ?>

            </div>
        </div>
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
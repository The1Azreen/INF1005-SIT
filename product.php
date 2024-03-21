<?php
session_start(); // Start the session

function getProducts()
{
    global $productId, $productName, $price, $errorMsg, $success;

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
                echo '<table>';
                echo '<tr><th>Product Name</th><th>Description</th><th>Price</th><th></th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['product_name'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>$' . $row['price'] . '</td>';
                    echo '<td>';
                    if (isset ($_SESSION["user"]) && $_SESSION["user"] != "") {
                        echo '<button class="btn btn-primary" style="text-align: center;" onclick="addToCart(' . $row['product_id'] . ', \'' . $row['product_name'] . '\', ' . $row['price'] . ')">Add to Cart</button>';
                    } else {
                        echo 'Please login to purchase items.';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
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
    <title>Products</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    if (isset ($_SESSION["user"]) == "") {
        include "inc/nav.inc.php";
    } else {
        include "inc/loginNav.inc.php";
    }
    ?>
    <br>
    <main class="container">

        <div class="row">
            <h2>Products</h2>
            <?php getProducts(); ?>


        </div>
        </div>
    </main>

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
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>

</html>
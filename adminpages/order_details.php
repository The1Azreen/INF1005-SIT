<?php

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

// Check if order_id is provided in the query parameters
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details including items from the order_product and product tables
    $get_order_details = "SELECT op.product_id, p.product_name, op.qty, p.price 
                          FROM order_products op 
                          INNER JOIN products p ON op.product_id = p.product_id 
                          WHERE op.order_id = $order_id";
    $order_details_result = mysqli_query($con, $get_order_details);

    if (mysqli_num_rows($order_details_result) > 0) {
        // Display order details
        echo "<h2>Order Details</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Unit Price</th></tr>";
        while ($row = mysqli_fetch_assoc($order_details_result)) {
            echo "<tr>";
            echo "<td>" . $row['product_id'] . "</td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['qty'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Add a back button
        echo "<br>";
        echo "<a href='../adminpages/index.php?list_orders'>Back</a>";
    } else {
        echo "No order details found for the provided order ID.";
    }
} else {
    echo "No order ID provided.";
}

// Close the database connection
$con->close();
?>
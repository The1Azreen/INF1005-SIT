<?php
session_start();
// Include database configuration
include "adminpages/inc/header.inc.php";

$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish connection to the database
$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product details from the form
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $product_price = $_POST['product_price'];

    // File upload
    $target_dir = "../images/ProductImages/"; 
    $target_file = $target_dir . basename($_FILES["product_image1"]["name"]);
    move_uploaded_file($_FILES["product_image1"]["tmp_name"], $target_file);

    // Prepare SQL statement to insert product into the database
    $sql = "INSERT INTO products (product_name, price, quantity, filePath, product_description) VALUES ('$product_title', '$product_price', '$quantity', '$target_file', '$description')";

    if ($conn->query($sql) === TRUE) {
        // Insert successful
        echo '<script>alert("Product inserted successfully");</script>';
        header("Location: index.php");
    } else {
        // Error occurred
        echo '<script>alert("Error occurred");</script>';
        header("Location: index.php");
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3Pyo1Y1cOd4DSE0Ga+r¡4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="quantity" class="form-label">Product quantity</label>
                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
            </div>
        </form>
    </div>
</body>

</html>

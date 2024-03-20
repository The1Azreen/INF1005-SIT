<!DOCTYPE html>
<html lang="en">
<head>
    <title>CircuitCart</title>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
</head>
<body>
<?php
// Include header.inc.php for the header section
include "inc/header.inc.php";
?>

<?php
// Include nav.inc.php for the header section
include "inc/nav.inc.php";
?>


<?php
session_start();

// Include database configuration
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
    die("Connection failed: " . $conn->connect_error);
}

// Fetching brand_title from the table
$sql_brand = "SELECT brand_title FROM ShopBrandPrototypeTable";
$result_brand = $conn->query($sql_brand);

// Fetching category_id from the table
$sql_category = "SELECT category_id FROM ShopCategoryPrototypeTable";
$result_category = $conn->query($sql_category);

// Close the database connection
$conn->close();
?>




<div class="bg-light">
    <h3 class="text-center">CircuitCart</h3>
    <p class="text-center">Communication is at the heart of e-commerce and community</p>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-info">Add to Cart</a>
                        <a href="#" class="btn btn-secondary">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-info">Add to Cart</a>
                        <a href="#" class="btn btn-secondary">View More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-info">Add to Cart</a>
                        <a href="#" class="btn btn-secondary">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 bg-secondary">
    <ul class="navbar-nav me-auto">
        <h1 style="font-size: 1.5rem; margin-bottom: 20px;">Delivery Brand</h1>
        <?php
        if ($result_brand->num_rows > 0) {
            // Output data of each row
            while($row = $result_brand->fetch_assoc()) {
                echo '<li class="nav-item bg-info">';
                echo '<a href="#" class="nav-link" style="color: #fff;">' . $row["brand_title"] . '</a>';
                echo '</li>';
            }
        } else {
            echo '<li class="nav-item bg-info">';
            echo '<a href="#" class="nav-link" style="color: #fff;">No brands available</a>';
            echo '</li>';
        }
        ?>
    </ul>
    <h1 style="font-size: 1.5rem; margin-bottom: 20px;">Category</h1>
    <ul class="navbar-nav me-auto">
        <?php
        if ($result_category->num_rows > 0) {
            // Output data of each row
            while($row = $result_category->fetch_assoc()) {
                echo '<li class="nav-item bg-info">';
                echo '<a href="#" class="nav-link" style="color: #fff;">' . $row["category_id"] . '</a>';
                echo '</li>';
            }
        } else {
            echo '<li class="nav-item bg-info">';
            echo '<a href="#" class="nav-link" style="color: #fff;">No categories available</a>';
            echo '</li>';
        }
        ?>
    </ul>
</div>






<?php
// Include footer.inc.php for the footer section
include "inc/footer.inc.php";
?>
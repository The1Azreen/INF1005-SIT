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
    echo "Connected successfully<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve brand title from the form
    $brand_title = $_POST['brand_title'];

    // Prepare SQL statement to insert brand into the database
    $sql = "INSERT INTO brands (brand_title) VALUES ('$brand_title')";

    if ($conn->query($sql) === TRUE) {
        // Insert successful
        echo '<script>alert("Insert successful");</script>';
    } else {
        // Error occurred
        echo '<script>alert("Error occurred");</script>';
    }
}

// Close the database connection
$conn->close();
?>

<!-- HTML Form -->
<div class="container">
    <h3 class="text-center text-success">Insert Brand</h3>
    <form action="" method="post" class="mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-info" id="basic-addon1">
                        <i class="fa-solid fa-receipt"></i>
                    </span>
                    <input type="text" class="form-control" name="cat_title" placeholder="Insert Brand" aria-label="Brand" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group">
                    <button type="submit" class="btn btn-info btn-block">Insert Brand</button>
                </div>
            </div>
        </div>
    </form>
</div>
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
} else {
    echo "Connected successfully<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve brand title from the form
    $brand_title = $_POST['brand_title'];

    // Prepare SQL statement to insert brand into the database
    $sql = "INSERT INTO ShopBrandPrototypeTable (brand_title) VALUES ('$brand_title')";

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

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" 
        aria-label="brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 auto">
        <button type="submit" class="bg-info p-2 my-3 border-0">Insert Brands</button>
    </div>
</form>

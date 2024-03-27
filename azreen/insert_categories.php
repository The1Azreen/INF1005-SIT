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
    // Retrieve category title from the form
    $cat_title = $_POST['cat_title'];

    // Prepare SQL statement to insert category into the database
    $sql = "INSERT INTO ShopCategoryPrototypeTable (category_title) VALUES ('$cat_title')";

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
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" 
        aria-label="categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 auto">
        <button type="submit" class="bg-info p-2 my-3 border-0">Insert Categories</button>
    </div>
</form>

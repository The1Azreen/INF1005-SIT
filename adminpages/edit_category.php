<?php
session_start();
//include "adminpages/inc/header.inc.php";
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve category title and ID from the form
    $category_id = $_POST['category_id'];
    $new_category_title = $_POST['new_category_title'];

    // Prepare SQL statement to update category title in the database
    $sql = "UPDATE categories SET category_title='$new_category_title' WHERE category_id=$category_id";

    if ($conn->query($sql) === TRUE) {
        // Update successful
        echo '<script>alert("Category updated successfully"); window.location.href = "index.php?view_categories";</script>';
    } else {
        // Error occurred
        echo '<script>alert("Error occurred while updating category");</script>';
    }
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <h3 class="text-center text-success">Edit Category</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info" id="basic-addon1">
                            <i class="fas fa-receipt"></i> <!-- Updated to use Font Awesome 6 classes -->
                        </span>
                        <input type="text" class="form-control" id="new_category_title" name="new_category_title" placeholder="New Category Title" aria-label="New Category Title" aria-describedby="basic-addon1" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="hidden" name="category_id" value="<?php echo $_GET['category_id']; ?>">
                        <button type="submit" class="btn btn-info btn-block">Update Category</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (optional, only if you need Bootstrap JS functionalities) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



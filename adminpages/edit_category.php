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
    <title>Edit Category</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h3 class="text-center text-success">Edit Category</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="new_category_title">New Category Title:</label>
            <input type="text" class="form-control" id="new_category_title" name="new_category_title" required>
        </div>
        <input type="hidden" name="category_id" value="<?php echo $_GET['category_id']; ?>">
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

<!-- Include Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>

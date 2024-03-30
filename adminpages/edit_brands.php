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
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve brand title and ID from the form
    $brand_id = $_POST['brand_id'];
    $new_brand_title = $_POST['new_brand_title'];

    // Prepare SQL statement to update brand title in the database
    $sql = "UPDATE brands SET brand_title='$new_brand_title' WHERE brand_id=$brand_id";

    if ($conn->query($sql) === TRUE) {
        // Update successful
        echo '<script>alert("Brand updated successfully"); window.location.href = "index.php?view_brands";</script>';
    } else {
        // Error occurred
        echo '<script>alert("Error occurred while editing brand"); window.location.href = "index.php?view_brands";</script>'
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<body>

<div class="container">
    <h3 class="text-center text-success">Edit Brand</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="new_brand_title">New Brand Title:</label>
            <input type="text" class="form-control" id="new_brand_title" name="new_brand_title" required>
        </div>
        <input type="hidden" name="brand_id" value="<?php echo $_GET['brand_id']; ?>">
        <button type="submit" class="btn btn-primary">Update Brand</button>
    </form>
</div>



</body>
</html>

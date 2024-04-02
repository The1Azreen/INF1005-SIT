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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['category_id'])) {
    // Get the category ID to delete
    $category_id = $_GET['category_id'];

    // Delete the category
    $sql_delete = "DELETE FROM categories WHERE category_id = $category_id";
    if ($conn->query($sql_delete) === TRUE) {
        // Category deleted successfully

        // Retrieve all categories
        $sql_select = "SELECT category_id FROM categories";
        $result = $conn->query($sql_select);

        // Update category IDs
        $new_category_id = 1;
        while ($row = $result->fetch_assoc()) {
            $old_category_id = $row['category_id'];
            // Update the category ID only if it's not equal to the deleted category ID
            if ($old_category_id != $category_id) {
                $sql_update = "UPDATE categories SET category_id = $new_category_id WHERE category_id = $old_category_id";
                $conn->query($sql_update);
                $new_category_id++;
            }
        }

        echo '<script>alert("Category deleted successfully"); window.location.href = "index.php?view_categories";</script>';
    } else {
        echo '<script>alert("Error occurred while deleting category"); window.location.href = "index.php?view_categories";</script>';
    }
} else {
    echo '<script>alert("Invalid request"); window.location.href = "index.php?view_categories";</script>';
}

// Close the database connection
$conn->close();
?>

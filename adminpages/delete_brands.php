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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['brand_id'])) {
    // Get the brand ID to delete
    $brand_id = $_GET['brand_id'];

    // Delete the brand
    $sql_delete = "DELETE FROM brands WHERE brand_id = $brand_id";
    if ($conn->query($sql_delete) === TRUE) {
        // Brand deleted successfully
        
        // Retrieve all remaining brand IDs
        $sql_select = "SELECT brand_id FROM brands";
        $result = $conn->query($sql_select);

        // Update brand IDs sequentially
        $new_brand_id = 1;
        while ($row = $result->fetch_assoc()) {
            $old_brand_id = $row['brand_id'];
            // Update the brand ID only if it's not equal to the deleted brand ID
            if ($old_brand_id != $brand_id) {
                $sql_update = "UPDATE brands SET brand_id = $new_brand_id WHERE brand_id = $old_brand_id";
                $conn->query($sql_update);
                $new_brand_id++;
            }
        }

        echo '<script>alert("Brand deleted successfully"); window.location.href = "index.php?view_brands";</script>';
    } else {
        echo '<script>alert("Error occurred while deleting brand"); window.location.href = "index.php?view_brands";</script>';
    }
} else {
    echo '<script>alert("Invalid request"); window.location.href = "index.php?view_brands";</script>';
}

// Close the database connection
$conn->close();
?>

<?php
session_start();
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['brand_id'])) {
    $brand_id = $_GET['brand_id'];

    // Delete the brand using a prepared statement
    $stmt_delete = $conn->prepare("DELETE FROM brands WHERE brand_id = ?");
    $stmt_delete->bind_param("i", $brand_id);
    if ($stmt_delete->execute()) {
        echo '<script>alert("Brand deleted successfully"); window.location.href = "index.php?view_brands";</script>';
    } else {
        echo '<script>alert("Error occurred while deleting brand"); window.location.href = "index.php?view_brands";</script>';
    }
    $stmt_delete->close();
} else {
    echo '<script>alert("Invalid request"); window.location.href = "index.php?view_brands";</script>';
}
$conn->close();
?>

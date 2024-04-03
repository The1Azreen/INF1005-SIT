<?php
session_start();

// Check if user is an admin
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'true') {
    header('Location: /index.php');
    exit();
}

// Include database configuration and connect to the database
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

$con = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get the product ID to delete
$product_id = $_GET['product_id'] ?? null;

if ($product_id) {
    // Check if product is used in order_products
    $stmt = $con->prepare("SELECT COUNT(*) FROM order_products WHERE product_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_row();
        
        if ($row[0] > 0) {
            // The product is in use
            
            echo '<script>alert("Cannot delete product as it is being used."); window.location.href = "index.php?view_products";</script>';
        } else {
            // The product is not in use, delete it
            $delete_stmt = $con->prepare("DELETE FROM products WHERE product_id = ?");
            if ($delete_stmt) {
                $delete_stmt->bind_param("i", $product_id);
                if ($delete_stmt->execute()) {
                    if ($delete_stmt->affected_rows > 0) {
                       
                        echo '<script>alert("Product deleted successfully."); window.location.href = "index.php?view_products";</script>';
                    } else {
                      
                        echo '<script>alert("Error deleting product: No such product exists."); window.location.href = "index.php?view_products";</script>';
                    }
                } else {
                    $_SESSION['message'] = 'Error executing product deletion.';
                }
                $delete_stmt->close();
            } else {
                $_SESSION['message'] = 'Error preparing statement for product deletion.';
            }
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Error preparing statement for product usage check.';
    }
} else {
    $_SESSION['message'] = 'Invalid product ID.';
}

$con->close();

exit();
?>

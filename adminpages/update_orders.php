<?php
// Check if the 'type' session variable is set to "true"
if (!isset($_SESSION['type']) || strcmp($_SESSION['type'], "true") !== 0) {
    // If not admin, redirect to main index or login page
    header('Location: /index.php');
    exit();
}
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'], $_POST['order_status'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $order_status, $order_id);
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
} else {
    echo "Invalid request method.";
    exit;
}
?>
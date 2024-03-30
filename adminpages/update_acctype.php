<?php
// Include database configuration
include "adminpages/inc/header.inc.php";
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish connection to the database
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if member_id and acc_type are set and valid
if (isset($_GET['member_id']) && isset($_GET['acc_type']) && filter_var($_GET['member_id'], FILTER_VALIDATE_INT)) {
    $member_id = $_GET['member_id'];
    $acc_type = $_GET['acc_type'];

    // Prepare SQL statement to update acc_type in the database
    $stmt = $conn->prepare("UPDATE members SET acc_type = ? WHERE member_id = ?");
    $stmt->bind_param("si", $acc_type, $member_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Update successful
        echo '<script>alert("Account Type Updated successfully."); window.location.href = "index.php?list_users";</script>';
    } else {
        // Error occurred
        echo '<script>alert("Account Type Updated successfully."); window.location.href = "index.php?list_users";</script>';
    }
} else {
    // Invalid request
    echo "Invalid request parameters.";
}

// Close the database connection
$conn->close();
?>

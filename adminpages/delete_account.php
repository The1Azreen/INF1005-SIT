<?php
session_start();

// Include database configuration
include "adminpages/inc/header.inc.php";

// Check if the 'type' session variable is set to "true"
if (!isset($_SESSION['type']) || $_SESSION['type'] !== "true") {
    // If not admin, redirect to main index or login page
    header('Location: /index.php');
    exit();
}

$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish connection to the database
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if member_id is set and is a valid integer
if (isset($_GET['member_id']) && filter_var($_GET['member_id'], FILTER_VALIDATE_INT)) {
    $member_id = $_GET['member_id'];

    // Ensure that the member_id is not the first one
    if ($member_id > 1) {
        // Prepare SQL statement to delete the member
        $stmt_delete = $conn->prepare("DELETE FROM members WHERE member_id = ?");
        $stmt_delete->bind_param("i", $member_id);

        // Execute the delete statement
        if ($stmt_delete->execute()) {
            // Update member IDs
            $stmt_update = $conn->prepare("UPDATE members SET member_id = ? WHERE member_id = ?");
            $new_member_id = 1;
            $stmt_update->bind_param("ii", $new_member_id, $old_member_id);
            $result_update = $conn->query("SELECT member_id FROM members");
            while ($row = $result_update->fetch_assoc()) {
                $old_member_id = $row['member_id'];
                if ($old_member_id != $member_id) {
                    $stmt_update->execute();
                    $new_member_id++;
                }
            }
            $stmt_update->close();
            
            // Redirect with success message
            header("Location: index.php?list_users&success=Account deleted successfully.");
            exit();
        } else {
            // Redirect with error message
            header("Location: index.php?list_users&error=Account deletion failed.");
            exit();
        }
    } else {
        // If member_id is the first one, redirect with error message
        header("Location: index.php?list_users&error=Cannot delete the first member.");
        exit();
    }
} else {
    // If member_id is not set or not a valid integer, redirect with error message
    header("Location: index.php?list_users&error=Invalid member ID.");
    exit();
}

// Close the database connection
$conn->close();
?>

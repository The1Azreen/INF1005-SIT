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
            $result_update = $conn->query("SELECT member_id FROM members");
            $new_member_id = 1;
            while ($row = $result_update->fetch_assoc()) {
                $old_member_id = $row['member_id'];
                if ($old_member_id != $member_id) {
                    $sql_update = "UPDATE members SET member_id = $new_member_id WHERE member_id = $old_member_id";
                    $conn->query($sql_update);
                    $new_member_id++;
                }
            }
            echo '<script>alert("Account deleted successfully."); window.location.href = "index.php?list_users";</script>';
            exit(); // Terminate script
        } else {
            // Handle error if deletion fails
            echo '<script>alert("Account deletion failed."); window.location.href = "index.php?list_users";</script>';
            exit(); // Terminate script
        }
    } else {
        // If member_id is the first one, do not allow deletion
        echo "Cannot delete the first member.";
        exit(); // Terminate script
    }
} else {
    // If member_id is not set or not a valid integer, show an error
    echo "Invalid member ID.";
    exit(); // Terminate script
}

// Close the database connection
$conn->close();
?>

<?php
// update_acctype.php

$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['member_id'], $_POST['acc_type'])) {
    $member_id = $_POST['member_id'];
    $acc_type = $_POST['acc_type'];

    if (filter_var($member_id, FILTER_VALIDATE_INT) && ($acc_type === 'true' || $acc_type === 'false')) {
        $stmt = $conn->prepare("UPDATE members SET acc_type = ? WHERE member_id = ?");
        $stmt->bind_param("si", $acc_type, $member_id);
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid request parameters.";
    }
    $conn->close();
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
} else {
    echo "Invalid request method.";
    exit;
}
?>

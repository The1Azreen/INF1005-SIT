<?php
session_start();

// Include database configuration
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish a connection to the database
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert_cat'])) {
    // Sanitize and validate input
    $cat_title = mysqli_real_escape_string($conn, $_POST['cat_title']);
    
    if (empty($cat_title)) {
        echo "<script>alert('Please enter a category title.')</script>";
    } else {
        // Insert category into the database
        $sql = "INSERT INTO " . $config['tables']['table3'] . " (category_title) VALUES ('$cat_title')";
        
        // Print SQL query for debugging
        echo "SQL Query: " . $sql . "<br>";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Category inserted successfully.')</script>";
            echo "<script>console.log('Category inserted successfully.')</script>"; // Log success to console
        } else {
            // Display MySQL error
            die("Error: " . $conn->error);
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Categories</title>
    <!-- Add any additional CSS or JavaScript libraries here -->
</head>
<body>
    <form action="" method="post" class="mb-2">
        <div class="input group w-90 mb-3">
            <span class="input-group-text bg-info" id="basic-addon1">
                <i class="fa-solid fa-receipt"></i>
            </span>
            <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" 
            aria-label="categories" aria-describedby="basic-addon1">
        </div>
        <div class="input group w-10 mb-2 auto">
            <button type="submit" class="bg-info p-2 my-3 border-0" name="insert_cat">Insert Categories</button>
        </div>
    </form>
</body>
</html>

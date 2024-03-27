<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>

<?php
include_once "inc/head.inc.php"; // Include head file
include_once "inc/nav.inc.php"; // Include nav file

session_start();

// Include database configuration
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Helper function to authenticate the login
function authenticateUser($email, $password)
{
    global $config, $fname, $lname, $errorMsg, $success;

    // Create database connection
    $conn = new mysqli(
        $config['servername'],
        $config['username'],
        $config['password'],
        $config['dbname']
    );

    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement
        $stmt = $conn->prepare("SELECT * FROM world_of_pets_members WHERE email=?");

        // Bind & execute the query statement
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $pwd_hashed = $row["password"];

            // Check if the password matches
            if (password_verify($password, $pwd_hashed)) {
                // Password is correct, set session variables
                $_SESSION["email"] = $email;
                $_SESSION["fname"] = $fname;
                $_SESSION["lname"] = $lname;
                $_SESSION["success_msg"] = "Login successful!";
                $success = true;
            } else {
                $errorMsg = "Invalid email or password";
                $success = false;
            }
        } else {
            $errorMsg = "Invalid email or password";
            $success = false;
        }
        $stmt->close();
        $conn->close();
    }
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs
    $email = $_POST["email"];
    $password = $_POST["pwd"];

    // Call the authenticateUser() function
    authenticateUser($email, $password);

    // Display success or error message without redirecting
    if ($success) {
        echo "<h4 class='text-center'>Login successful!</h4>";
        echo "<p class='text-center'>Email: $email</p>";
        echo "<div class='text-center mb-3'><button onclick='goBack()' class='btn btn-success'>Go Back</button></div>";
    } else {
        $_SESSION["error"] = $errorMsg;
        echo "<h4 class='text-center'>Login Failed!</h4>";
        echo "<p class='text-center'>Email: $email</p>";
        echo "<div class='text-center mb-3'><button onclick='goBack()' class='btn btn-success'>Go Back</button></div>";
    }
}
?>

<script>
    // Function to navigate back
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>

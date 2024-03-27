<?php
include_once "inc/head.inc.php"; // Include head file
include_once "inc/nav.inc.php"; // Include nav file

// Initialize variables
$fname = $lname = $email = $pwd = $pwd_confirm = $errorMsg = "";
$success = true;

// Validate and sanitize form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize other form inputs similarly as you did for email

    // Validate and sanitize first name
    if (empty($_POST["fname"])) {
        $errorMsg .= "First Name is required.<br>";
        $success = false;
    } else {
        $fname = sanitize_input($_POST["fname"]);
    }

    // Validate and sanitize last name
    if (empty($_POST["lname"])) {
        $errorMsg .= "Last Name is required.<br>";
        $success = false;
    } else {
        $lname = sanitize_input($_POST["lname"]);
    }

    // Validate and sanitize email
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }

    // Validate and sanitize password
    if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"]) || $_POST["pwd"] !== $_POST["pwd_confirm"]) {
        $errorMsg .= "Passwords do not match.<br>";
        $success = false;
    } else {
        $pwd = sanitize_input($_POST["pwd"]);
    }

    // If form data is valid, proceed to save member to database
    if ($success) {
        // Hash the password for security
        $pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);

        // Call function to save member to database
        if (saveMemberToDB($email, $fname, $lname, $pwd_hashed)) {
            // Display success message
            echo "<h4 class='text-center'>Registration successful!</h4>";
            echo "<p class='text-center'>Email: " . $email . "</p>";
            echo "<div class='text-center mb-3'><button onclick='goBack()' class='btn btn-success'>Go Back</button></div>";
        } else {
            // Display error message
            $errorMsg = "An account already exists with this email.";
            echo "<h4 class='text-center'>The following input errors were detected:</h4>";
            echo "<p class='text-center'>" . $errorMsg . "</p>";
            echo "<div class='text-center mb-3'><button onclick='goBack()' class='btn btn-success'>Go Back</button></div>";
        }
    } else {
        // Display error message
        echo "<h4 class='text-center'>The following input errors were detected:</h4>";
        echo "<p class='text-center'>" . $errorMsg . "</p>";
        echo "<div class='text-center mb-3'><button onclick='goBack()' class='btn btn-success'>Go Back</button></div>";
    }
}

// Function to save member to database
function saveMemberToDB($email, $fname, $lname, $pwd_hashed)
{
    // Create database connection
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        return false; // Failed to read database config file
    }

    $conn = new mysqli(
        $config['servername'],
        $config['username'],
        $config['password'],
        $config['dbname']
    );

    // Check connection
    if ($conn->connect_error) {
        return false; // Connection failed
    }

    // Check if the email already exists
    $check_stmt = $conn->prepare("SELECT * FROM world_of_pets_members WHERE email=?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Email already exists
        $check_stmt->close();
        $conn->close();
        return false;
    }

    // Email does not exist, proceed to insert new member
    $insert_stmt = $conn->prepare("INSERT INTO world_of_pets_members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
    $result = $insert_stmt->execute();

    // Close statements and connection
    $insert_stmt->close();
    $conn->close();

    return $result;
}

// Sanitize input function
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include_once "inc/footer.inc.php"; // Include footer file
?>

<script>
    // Function to navigate back
    function goBack() {
        window.history.back();
    }
</script>

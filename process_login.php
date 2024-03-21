<?php
session_start(); // Start the session
/*
* Helper function that checks input for malicious or unwanted content.
*/
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
/*
 * Helper function to authenticate the login.
 */
function authenticateUser()
{
    global $memberid, $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
    $success = true;
    // Create database connection.
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
    } else {
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
            // Prepare the statement:
            $stmt = $conn->prepare("SELECT * FROM members WHERE email=?");
            // Bind & execute the query statement:
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // Note that email field is unique, so should only have
                // one row in the result set.
                $row = $result->fetch_assoc();
                $memberid = $row["member_id"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $pwd_hashed = $row["password"];
                // Check if the password matches:
                if (!password_verify($_POST["pwd"], $pwd_hashed)) {
                    // Don't be too specific with the error message - hackers don't
                    // need to know which one they got right or wrong. :)
                    $errorMsg = "password doesn't match...";
                    $success = false;
                }
            } else {
                $errorMsg = "Email not found";
                $success = false;
            }
            $stmt->close();
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Login</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    include "inc/nav.inc.php";
    ?>
    <main class="container">
        <div>
            <?php
            $email = $mailerrorMsg = "";
            $pwd = $passerrorMsg = "";
            $mailsuccess = true;
            $passsuccess = true;
            if (empty ($_POST["email"])) {
                $mailerrorMsg .= "Email is required.<br>";
                $mailsuccess = false;
            } else {
                $email = sanitize_input($_POST["email"]);
                // Additional check to make sure e-mail address is well-formed.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mailerrorMsg .= "Invalid email format.";
                    $mailsuccess = false;
                }
            }
            if (empty ($_POST["pwd"])) {
                $passerrorMsg .= "Passwords is required.<br>";
                $passsuccess = false;
            }

            authenticateUser();

            if ($mailsuccess && $passsuccess&& $success) {
                ?>
                <div style="padding: 20px; 
                border-top: 2px solid #D3D3D3; 
                margin-top: 10px; 
                border-bottom: 2px solid #D3D3D3;
                margin-bottom: 10px;">
                    <h3><b>Login successful!</b></h3>
                    <h4>Welcome back,
                        <?php echo $fname . " " . $lname; ?>
                    </h4>
                    <input onclick="window.location='index.php'" class="btn btn-success" type="submit"
                        value="Return to Home">
                </div>

                <?php 
                    $_SESSION['user'] = $fname; 
                    $_SESSION['memberid'] = $memberid;
                ?> <!-- Set Session Username and ID -->
                <?php
            } else {
                ?>
                <div style="padding: 20px; 
                border-top: 2px solid #D3D3D3; 
                margin-top: 10px; 
                border-bottom: 2px solid #D3D3D3;
                margin-bottom: 10px;">
                    <h3><b>Oops!</b></h3>
                    <h4><b>The following errors were detected:</b></h4>
                    <p>
                        <?php echo $errorMsg; ?>
                    </p>
                    <input onclick="window.location='login.php'" class="btn btn-warning" type="submit"
                        value="Return to Login" />
                </div>
                <?php
            }
            ?>
        </div>
    </main>
    <?php
    include "inc/footer.inc.php";
    ?>
</body>

</html>
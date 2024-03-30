<?php
session_start();

/*
 * Helper function to update user password to DB.
 */
function updatepassword()
{
    global $success, $errorMsg;

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
            $password = $_POST["pass"];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("SELECT * FROM members WHERE member_id = ?");
            // Bind & execute the query statement:
            $stmt->bind_param("s", $_SESSION["memberid"]);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $stmt->close();

                $stmt = $conn->prepare("UPDATE members SET password = ? WHERE member_id = ?");
                // Bind & execute the update statement:
                $stmt->bind_param("ss", $hashedPassword, $_SESSION["memberid"]);

                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                } else {
                    $success = true;
                }
                $stmt->close();
            } else {
                $errorMsg = "Member not found.";
                $success = false;
            }
            $conn->close();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    include "inc/loginNav.inc.php";
    ?>
    <main class="container">
        <div>
            <?php
            $pwd = $passerrorMsg = "";
            $passsuccess = true;
            if (empty ($_POST["pass"])) {
                $passerrorMsg = "Passwords is required.<br>";
                $passsuccess = false;
            } else {
                if (!($_POST["pass"] == $_POST["pass_confirm"])) {
                    $passerrorMsg = "Password do not match.";
                    $passsuccess = false;
                }
            }
            
            if ($passsuccess) {
                updatepassword();
                if ($success){
                    ?>
                    <div style="padding: 20px; 
                border-top: 2px solid #D3D3D3; 
                margin-top: 10px; 
                border-bottom: 2px solid #D3D3D3;
                margin-bottom: 10px;">
                        <h3><b>Your password is updated!</b></h3>
                        <input onclick="window.location='user.php'" class="btn btn-success" type="submit" 
                        value="Return to profile">
                    </div>
                    <?php
                }
                else{
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
                        <input onclick="window.location='user.php'" class="btn btn-danger" type="submit"
                            value="Return to profile" />
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </main>
    <?php
    include "inc/footer.inc.php";
    ?>
</body>

</html>
<?php
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
 * Helper function to write the member data to the database.
 */
function saveMemberToDB()
{
    // Create database connection.
    $config = parse_ini_file('/var/www/private/db-config.ini');
    global $email, $fname, $lname, $pwd, $errorMsg, $success;
    $success = true;
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
        // Prepare the statement to retrieve existing member IDs:
        $stmt = $conn->prepare("SELECT member_id FROM members ORDER BY member_id");
        // Execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        $existing_ids = [];
        while ($row = $result->fetch_assoc()) {
            $existing_ids[] = $row['member_id'];
        }
        
        // Find the first missing member ID:
        $missing_id = 1;
        foreach ($existing_ids as $id) {
            if ($missing_id != $id) {
                break;
            }
            $missing_id++;
        }

        // Prepare the statement to insert new member:
        $stmt = $conn->prepare("INSERT INTO members (member_id, fname, lname, email, password, acc_type) 
            VALUES (?, ?, ?, ?, ?, ?)");
        
        // Capture user input
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        // Hash the password
        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
        $accType = 'false';

        // Bind & execute the query statement:
        $stmt->bind_param("isssss", $missing_id, $fname, $lname, $email, $hashedPassword, $accType);

        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }

        $stmt->close();
        $conn->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project</title>
    <?php include "inc/head.inc.php"; ?>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>
    <main class="container">
        <div>
            <?php
            $email = $mailerrorMsg = "";
            $pwd = $passerrorMsg = "";
            $mailsuccess = true;
            $passsuccess = true;
            if (empty($_POST["email"])) {
                $mailerrorMsg = "Email is required.<br>";
                $mailsuccess = false;
            } else {
                $email = sanitize_input($_POST["email"]);
                // Additional check to make sure e-mail address is well-formed.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mailerrorMsg = "Invalid email format.";
                    $mailsuccess = false;
                }
            }
            if (empty($_POST["pwd"])) {
                $passerrorMsg = "Passwords is required.<br>";
                $passsuccess = false;
            } else {
                if (!($_POST["pwd"] == $_POST["pwd_confirm"])) {
                    $passerrorMsg = "Password do not match.";
                    $passsuccess = false;
                }
            }
            if ($mailsuccess && $passsuccess) {
                saveMemberToDB();
                if ($success) {
            ?>
                    <div style="padding: 20px; border-top: 2px solid #D3D3D3; margin-top: 10px; border-bottom: 2px solid #D3D3D3; margin-bottom: 10px;">
                        <h3><b>Your registration is successful!</b></h3>
                        <h4>Thank you for signing up,
                            <?php echo $_POST["fname"] . " " . $_POST["lname"]; ?>
                        </h4>
                        <input onclick="window.location='index.php'" class="btn btn-success" type="submit" value="Log-in">
                    </div>
                <?php
                } else {
                ?>
                    <div style="padding: 20px; border-top: 2px solid #D3D3D3; margin-top: 10px; border-bottom: 2px solid #D3D3D3; margin-bottom: 10px;">
                        <h3><b>Oops!</b></h3>
                        <h4><b>The following errors were detected:</b></h4>
                        <p>
                            <?php echo $errorMsg; ?>
                        </p>
                        <input onclick="window.location='register.php'" class="btn btn-danger" type="submit" value="Return to Sign Up" />
                    </div>
                <?php
                }
            } else {
                ?>
                <div style="padding: 20px; border-top: 2px solid #D3D3D3; margin-top: 10px; border-bottom: 2px solid #D3D3D3; margin-bottom: 10px;">
                    <h3><b>Oops!</b></h3>
                    <h4><b>The following errors were detected:</b></h4>
                    <p>
                        <?php echo $mailerrorMsg; ?>
                    </p>
                    <p>
                        <?php echo $passerrorMsg; ?>
                    </p>
                    <input onclick="window.location='register.php'" class="btn btn-danger" type="submit" value="Return to Sign Up" />
                </div>
            <?php
            }
            ?>
        </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>

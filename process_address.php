<?php
session_start(); // Start the session
/*
 * Helper function to update user address to DB.
 */
function updateAddress()
{
    global $success, $errorMsg, $address, $floor, $unit, $address_type;

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
        } else { // Prepare the statement:
            $address = $_POST["address"];
            $floor = $_POST["floor"];
            $unit = $_POST["unit"];
            $address_type = $_POST["address_type"];

            $stmt = $conn->prepare("SELECT * FROM member_address AS ma 
            JOIN members AS m ON ma.member_id = m.member_id WHERE m.fname =?");
            // Bind & execute the query statement:
            $stmt->bind_param("s", $_SESSION["user"]);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {

                $stmt = $conn->prepare("UPDATE member_address AS ma
                JOIN members AS m ON ma.member_id = m.member_id
                SET ma.address =?,
                    ma.floor =?,
                    ma.unit = ?,
                    ma.address_type =?
                WHERE m.fname =?");
                $stmt->bind_param("sssss", $address, $floor, $unit, $address_type, $_SESSION["user"]);

                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                } 
                else {
                    $success = true;
                }

                $stmt->close();
            } else {
                $stmt = $conn->prepare("INSERT INTO member_address (member_id, address, floor, unit, address_type)
                VALUES (?, ?, ?, ?, ?)");

                $stmt->bind_param("sssss",$_SESSION["memberid"] , $address, $floor, $unit, $address_type);

                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                }
                else {
                    $success = true;
                }
                $stmt->close();
            }
            $conn->close();
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    include "inc/loginNav.inc.php";
    ?>
    <br>
    <main class="container">
        <div>
            <?php
            if ((empty ($_POST["address"])) && (empty ($_POST["floor"])) 
            && (empty ($_POST["unit"])) && (empty ($_POST["address_type"]))){
                $errorMsg = "Please fill in all fields.<br>";
                $success = false;
            }
            else{
                updateAddress();
                if ($success){
                ?>
                <div style="padding: 20px; 
                border-top: 2px solid #D3D3D3; 
                margin-top: 10px; 
                border-bottom: 2px solid #D3D3D3;
                margin-bottom: 10px;">
                    <h3><b>Your address has been updated</b></h3>
                    <br>
                    <?php 
                        if ($_SESSION["current_page"] == "user_address.php"){  ?>
                            <input onclick="window.location='user_profile.php'" class="btn btn-success" type="submit" value="Back">
                        <?php } else { ?>
                            <input onclick="window.location='checkout.php'" class="btn btn-success" type="submit" value="Back">
                        <?php } ?>
                    <br>
                </div>
                <?php
                }
                else {
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
                        <?php 
                        if ($_SESSION["current_page"] == "user_address.php"){  ?>
                             <input onclick="window.location='user_profile.php'" class="btn btn-danger" type="submit"
                            value="Return to profile page" />
                        <?php } else { ?>
                            <input onclick="window.location='checkout.php'" class="btn btn-danger" type="submit"
                            value="Return to checkout page" />
                        <?php } ?>
                       
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
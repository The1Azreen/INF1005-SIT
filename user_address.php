<?php
session_start(); // Start the session
$_SESSION["current_page"] = "user_address.php";
function getMemberAddress()
{
    global $address, $floor, $unit, $address_type, $errorMsg, $success;
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
            $stmt = $conn->prepare("SELECT * FROM member_address AS ma JOIN members AS m ON ma.member_id = m.member_id WHERE m.fname =?");
            // Bind & execute the query statement:
            $stmt->bind_param("s", $_SESSION["user"]);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $address = $row["address"];
                $floor = $row["floor"];
                $unit = $row["unit"];
                $address_type = $row["address_type"];
            }
            $stmt->close();
            $conn->close();
        }
    }
}
getMemberAddress();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    include "inc/nav.inc.php";
    ?>
    <br>
    <main class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Address</h2>
                <form action="process_address.php" method="POST">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input required type="text" class="form-control" id="address" name="address"
                            value="<?php echo $address; ?>">
                    </div>
                    <div class="form-group">
                        <label for="floor">Floor:</label>
                        <input required type="text" class="form-control" id="floor" name="floor"
                            value="<?php echo $floor; ?>">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit:</label>
                        <input required type="text" class="form-control" id="unit" name="unit"
                            value="<?php echo $unit; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address_type">Type:</label>
                        <input required type="text" class="form-control" id="address_type" name="address_type"
                            value="<?php echo $address_type; ?>">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Update Address</button>
                    <a href="user.php" class="btn btn-secondary">Back</a>
                </form>
                <br><br>
            </div>
        </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
<?php
session_start();

/*
 * Helper function to get member address
 */
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
            else {
                $address = "No Address Saved.";
            }
            $conn->close();
        }
    }
}
getMemberAddress();

/*
 * Helper function to get member orders
 */
function getMemberOrder()
{
    global $order_id, $total_qty, $total_price, $status, $errorMsg, $success;
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
            echo "<h2>Current Orders:</h2>";
            // Prepare the statement:
            $stmt = $conn->prepare("SELECT * FROM orders AS o INNER JOIN members AS m ON o.member_id = m.member_id WHERE o.order_status != 'completed' AND m.fname = ?");
            // Bind & execute the query statement:
            $stmt->bind_param("s", $_SESSION['user']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>Order ID: " . $row["order_id"] . '&nbsp;&nbsp;&nbsp; Total Items: ' . $row["total_qty"] . '&nbsp;&nbsp;&nbsp; Status: ' . $row["order_status"] . "</li>";
                    
                }
                echo "</ul>";
            } else {
                echo "No orders found.";
            }
            $conn->close();
        }
    }
}
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
        include "inc/loginNav.inc.php";
    ?>
    <br>
     <main class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>User Profile</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <h5><b><?php echo $_SESSION["user"]; ?></b></h5>
                        </tr>
                        <tr>
                            <th>
                                Address: 
                            </th>
                           
                        </tr>
                        <tr>
                            <td>
                            <?php echo $address; ?>,
                            <?php echo $floor; ?>,
                            <?php echo $unit; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="user_address.php" class="btn btn-primary">Update Address</a>
                <br><br>
                <a href="user_password.php" class="btn btn-primary">Change Password</a>
                <br><br>
            </div>
            <div class="col-md-6">
                <?php getMemberOrder(); ?>
            </div>
        </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
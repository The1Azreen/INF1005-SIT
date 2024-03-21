<?php
session_start(); // Start the session

global $errorMsg, $success, $insert;
$success = false;
$insert = false;

// Check if payment type is selected
if (!isset($_POST['payment'])) {
    $errorMsg = "Please select a payment type.";
    $success = false;
}

// Check if delivery address is set
if (!isset($_SESSION['address'])) {
    $errorMsg = "Please enter a delivery address.";
    $success = false;
}

/*
 * Helper function to save order and retrieve inserted data.
 */
function saveOrder()
{
    global $errorMsg, $success, $insert;

    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
        return false;
    }

    $conn = new mysqli(
        $config['servername'],
        $config['username'],
        $config['password'],
        $config['dbname']
    );

    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
        return false;
    }

    $stmt = $conn->prepare("INSERT INTO orders (member_id, total_qty, total_price, payment_id, order_status, delivery_address) 
                            VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        $errorMsg = "Failed to prepare statement: " . $conn->error;
        $success = false;
        $conn->close();
        return false;
    }

    $status = "pending";
    $stmt->bind_param("ssssss", $_SESSION['memberid'], $_SESSION['totalQty'], $_SESSION['totalPrice'], $_POST['payment'], $status, $_SESSION['address']);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $insert = true;
        $order_id = $conn->insert_id;
        // Query to retrieve the inserted data
        $select_stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
        $select_stmt->bind_param("i", $order_id);
        $select_stmt->execute();
        $result = $select_stmt->get_result();
        if (!$result->num_rows > 0) {
            echo "No orders found.";
        }
        $success = true;
    } else {
        $errorMsg = "Error with checkout, please try again later.";
        $success = false;
    }

    $stmt->close();
    $conn->close();

    return $insert;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
    <?php include "inc/head.inc.php"; ?>
</head>

<body>
    <?php include "inc/loginNav.inc.php"; ?>
    <main class="container">
        <div>
            <?php
            if (saveOrder()) {
                ?>
                <div style="padding: 20px; 
                border-top: 2px solid #D3D3D3; 
                margin-top: 10px; 
                border-bottom: 2px solid #D3D3D3;
                margin-bottom: 10px;">
                    <h3><b>Order Confirmed!</b></h3>
                    <br>
                    <?php 
                        unset($_SESSION['cart']); 
                        unset($_SESSION['totalQty']); 
                        unset($_SESSION['totalPrice']); 
                    ?>
                    <input onclick="window.location='index.php'" class="btn btn-success" type="submit"
                           value="Return to Home">
                    <br>
                </div>
                <?php
            } else {
                ?>
                <div style="padding: 20px; 
                border-top: 2px solid #D3D3D3; 
                margin-top: 10px; 
                border-bottom: 2px solid #D3D3D3;
                margin-bottom: 10px;">
                    <h3><b>Error!</b></h3>
                    <h4><b></b></h4>
                    <p><?php echo $errorMsg; ?></p>
                    <input onclick="window.location='checkout.php'" class="btn btn-warning" type="submit"
                           value="Return to checkout"/>
                    <br>
                </div>
                <?php
            }
            ?>
        </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>

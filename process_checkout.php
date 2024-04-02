<?php
session_start(); // Start the session


global $errorMsg, $success, $insert;
$success = true;

// Check if payment type is selected
if (!isset ($_POST['payment'])) {
    $errorMsg = "Please select a payment type.";
    $success = false;
}

// Check if delivery address is set
if (!isset ($_SESSION['address'])) {
    $errorMsg = "Please enter a delivery address.";
    $success = false;
}
/*
 * Helper function to save order and retrieve inserted data.
 */
function saveOrder()
{
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
    }
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
        $status = "pending";
        // Prepare the statement:
        $stmt = $conn->prepare("INSERT INTO orders (member_id, total_qty, total_price, payment_id, order_status, delivery_address) 
                            VALUES (?, ?, ?, ?, ?, ?)");
        // Bind & execute the query statement:
        $stmt->bind_param("ssssss", $_SESSION['memberid'], $_SESSION['totalQty'], $_SESSION['totalPrice'], $_POST['payment'], $status, $_SESSION['address']);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $success = true;
            // Insertion successful
            $order_id = $conn->insert_id;
            // Rest of your code for retrieving inserted data
            foreach ($_SESSION['cart'] as $key => $item) {
                $product_id = $item['product_id'];
                $qty = $item['quantity'];
                $stmt = $conn->prepare("INSERT INTO order_products (product_id, order_id, qty) VALUES (?, ?, ?)");
                $stmt->bind_param("iii",$product_id, $order_id,  $qty);
                $stmt->execute();
            }
        } else {
            $errorMsg = "Error with checkout, please try again later.";
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
    return $success;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
    <?php include "inc/head.inc.php"; ?>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>
    <main class="container">
        <div>
            <?php
            if (saveOrder()) { ?>
                <div class="message-page">
                    <h3><b>Order Confirmed!</b></h3>
                    <br>
                    <?php
                    unset($_SESSION['cart']);
                    unset($_SESSION['totalQty']);
                    unset($_SESSION['totalPrice']);
                    ?>
                    <input onclick="window.location='user.php'" class="btn btn-success" type="submit"
                        value="Return to Home">
                    <br>
                    <?php
            } else { ?>
                    <div class="message-page">
                        <h3><b>Error!</b></h3>
                        <h4><b></b></h4>
                        <p>
                            <?php echo $errorMsg; ?>
                        </p>
                        <input onclick="window.location='checkout.php'" class="btn btn-warning" type="submit"
                            value="Return to checkout" />
                        <br>
                    </div>
                    <?php
            } ?>
            </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
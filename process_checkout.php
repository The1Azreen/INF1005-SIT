<?php
session_start(); // Start the session


global $errorMsg, $success;
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
    global $errorMsg, $success;
    $success = true;

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
    
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
        return false;
    }

    // Start transaction
    $conn->begin_transaction();

    $status = "pending";
    $stmt = $conn->prepare("INSERT INTO orders (total_qty, total_price, order_status, delivery_address, member_id, payment_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $_SESSION['totalQty'], $_SESSION['totalPrice'], $status,  $_SESSION['address'], $_SESSION['memberid'], $_POST['payment']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $order_id = $conn->insert_id;
        foreach ($_SESSION['cart'] as $key => $item) {
            $product_id = $item['product_id'];
            $qty = $item['quantity'];
            // Update product quantity in database
            $updateStmt = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE product_id = ?");
            $updateStmt->bind_param("ii", $qty, $product_id);
            $updateStmt->execute();
            // Insert into order_products table
            $orderProductStmt = $conn->prepare("INSERT INTO order_products (product_id, order_id, qty) VALUES (?, ?, ?)");
            $orderProductStmt->bind_param("iii", $product_id, $order_id,  $qty);
            $orderProductStmt->execute();
        }
        $conn->commit();
    } else {
        $errorMsg = "Error with checkout, please try again later.";
        $success = false;
        $conn->rollback();
        return false;
    }

    $stmt->close();
    $updateStmt->close();
    $orderProductStmt->close();
    $conn->close();
    return true;
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
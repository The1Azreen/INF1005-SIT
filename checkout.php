<?php
session_start(); // Start the session

$_SESSION["current_page"] = "checkout.php";
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
                $_SESSION['address'] = $row["address"] . " " . $row["floor"] . " " . $row["unit"];
                $address = $row["address"];
                $floor = $row["floor"];
                $unit = $row["unit"];
                $address_type = $row["address_type"];

            } else {
                $address = "No Address Saved.";
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
    <title>Checkout</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    include "inc/loginNav.inc.php";
    ?>
    <main class="container">
        <div class="row">
            <div class="col-md-9">
                <h2><u>Cart</u></h2>
                <form action="process_checkout.php" method="POST">
                    <?php if (!$cart_empty) { ?>
                        <table class="checkout_cart">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $item) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $item['product_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $item['quantity'];
                                             ?>
                                            
                                        </td>
                                        <td>
                                            $<?php echo $item['price'];
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- Display total price -->
                        <br>
                        <p>Total:
                            <?php echo '$' . number_format($totalPrice, 2); 
                            ?>
                        </p>
                        <br>
                        <p>Payment type:</p>
                        <input type="radio" id="payment1" name="payment" value="1">
                        <label for="payment1">Credit Card</label><br>
                        <input type="radio" id="payment2" name="payment" value="2">
                        <label for="payment2">Paynow/PayLah</label><br><br>
                        <button type="submit" class="btn btn-primary">Checkout</button><br><br>
                    <?php } else { ?>
                        <p>Your cart is empty.</p>
                    <?php } ?>
                </form>
            </div>
            <div class="shipping-address-container col-md-3">
                <h2>Shipping Address</h2>
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
                </form>
                <br><br>
            </div>
        </div>
        </div>
    </main>
    <?php
    include "inc/footer.inc.php";
    ?>
</body>

</html>
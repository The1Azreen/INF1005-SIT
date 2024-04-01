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
                <form action="process_checkout.php" method="POST" onsubmit="return validateForm();">
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
                                            $
                                            <?php echo $item['price'];
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
                        <label for="payment2">Cash on delivery</label><br><br>
                        <!-- Credit Card Details -->
                        <div id="creditCardDetails" style="display: none;">
                            <div class="form-group">
                                <label for="cardNumber">Card Number:</label>
                                <input type="text" class="form-control" id="cardNumber" name="cardNumber"
                                    placeholder="Enter your card number">
                            </div>
                            <div class="form-group">
                                <label for="expiryDate">Expiry Date:</label>
                                <input type="text" class="form-control" id="expiryDate" name="expiryDate"
                                    placeholder="MM/YY">
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV:</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV">
                            </div>
                        </div>
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

<script>

    function sanitize_input(data) {
        // Trim leading/trailing whitespace
        data = data.trim();
        // Replace any < or > with their HTML entity equivalents
        data = data.replace(/</g, "&lt;").replace(/>/g, "&gt;");
        // Replace any " or ' with their HTML entity equivalents
        data = data.replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        return data;
    }
    // Function to toggle credit card details based on payment selection
    function toggleCreditCardDetails() {
        var payment1 = document.getElementById("payment1");
        var creditCardDetails = document.getElementById("creditCardDetails");

        creditCardDetails.style.display = payment1.checked ? "block" : "none";
    }

    function validateForm() {
        var payment1 = document.getElementById("payment1");
        var creditCardDetails = document.getElementById("creditCardDetails");
        var cardNumber = document.getElementById("cardNumber");
        var expiryDate = document.getElementById("expiryDate");
        var cvv = document.getElementById("cvv");

        // If credit card payment is selected and credit card details are visible, validate the fields
        if (payment1.checked && creditCardDetails.style.display !== "none") {
            // Check if card number, expiry date, and CVV are filled
            if (cardNumber.value.trim() === "" || expiryDate.value.trim() === "" || cvv.value.trim() === "") {
                alert("Please fill in all credit card details.");
                return false; // Prevent form submission
            } else {
                // Sanitize credit card input fields
                cardNumber.value = sanitize_input(cardNumber.value);
                expiryDate.value = sanitize_input(expiryDate.value);

                // Check card number and CVV using regex
                var cardNumberRegex = /^\d{16}$/; // Assumes card number is exactly 16 digits
                var cvvRegex = /^\d{3}$/; // Assumes CVV is exactly 3 digits

                if (!cardNumberRegex.test(cardNumber.value)) {
                    alert("Please enter a valid 16-digit card number.");
                    return false; // Prevent form submission
                }
                if (!cvvRegex.test(cvv.value)) {
                    alert("Please enter a valid 3-digit CVV.");
                    return false; // Prevent form submission
                }
            }
        }

        // Proceed with form submission
        return true;
    }

    // Add event listener to payment radio buttons
    var paymentRadios = document.getElementsByName("payment");
    for (var i = 0; i < paymentRadios.length; i++) {
        paymentRadios[i].addEventListener("change", toggleCreditCardDetails);
    }

    // Call the function initially to set the display based on default selection
    toggleCreditCardDetails();
</script>
<?php
session_start();
// Include database configuration
// Check if the 'type' session variable is set to "true"
if (!isset($_SESSION['type']) || strcmp($_SESSION['type'], "true") !== 0) {
    // If not admin, redirect to main index or login page
    header('Location: /index.php');
    exit();
}
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish connection to the database
$con = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

<aside>
    <h3 class="text-center text-success">All Orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr class="text-center">
                <th>Order ID</th>
                <th>Member ID</th>
                <th>Total Qty</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>
            <?php
            $get_orders = "SELECT * FROM orders where order_status != 'Delivered'";
            $result = mysqli_query($con, $get_orders);
            $row_count = mysqli_num_rows($result);

            if ($row_count == 0) {
                echo "<tr><td colspan='7' class='text-danger text-center mt-5'>No orders yet</td></tr>";
            } else {
                while ($row_data = mysqli_fetch_assoc($result)) {
                    $order_id = $row_data['order_id'];
                    $user_id = $row_data['member_id'];
                    $total_qty = $row_data['total_qty'];
                    $amount_due = $row_data['total_price'];
                    $order_status = $row_data['order_status'];

                    echo "<tr>
                    <td><a href='order_details.php?order_id=$order_id'>$order_id</a></td>
                    <td>$user_id</td>
                    <td>$total_qty</td>
                    <td>$amount_due</td>
                    <td> 
                    <form action='update_orders.php' method='post' onchange='this.submit()'>
                    <input type='hidden' name='order_id' value='$order_id'>
                    <select aria-label='status_select' class='form-control' name='order_status'>
                        <option value='Pending' " . ($order_status == 'Pending' ? 'selected' : '') . ">Pending</option>
                        <option value='Packed' " . ($order_status == 'Packed' ? 'selected' : '') . ">Packed</option>
                        <option value='Shipped' " . ($order_status == 'Shipped' ? 'selected' : '') . ">Shipped</option>
                        <option value='Delivered' " . ($order_status == 'Delivered' ? 'selected' : '') . ">Delivered</option>
                    </select>
                    </form>
                    </td>
                </tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <script>
        function updateStatus(selectElement, orderId) {
            var status = selectElement.value;
            document.getElementById('order_status_' + orderId).value = status;

        }</script>
    <?php
    // Close the database connection
    $conn->close();
    ?>
</aside>
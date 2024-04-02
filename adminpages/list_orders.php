<?php
// Include database configuration
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
            <th>Update</th>
        </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
        <?php
        $get_orders = "SELECT * FROM orders where order_status != 'completed'";
        $result = mysqli_query($con, $get_orders);
        $row_count = mysqli_num_rows($result);


        if ($row_count == 0) {
            echo "<tr><td colspan='7' class='text-danger text-center mt-5'>No orders yet</td></tr>";
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $user_id = $row_data['member_id'];
                $total_qty = $row_data['total_qty'];
                $amount_due = $row_data['total_price'];
                $order_status = $row_data['order_status'];
                $number++;
                echo " <tr>
                <td>$order_id</td>
                <td>$user_id</td>
                <td>$total_qty</td>
                <td>$amount_due</td>
                <td> ";
                echo "<select class='form-control' name='order_status'>";
                echo "<option value='Packed' " . ($order_status == 'Packed' ? 'selected' : '') . ">Packed</option>";
                echo "<option value='Shipped' " . ($order_status == 'Shipped' ? 'selected' : '') . ">Shipped</option>";
                echo "<option value='Delivered' " . ($order_status == 'Delivered' ? 'selected' : '') . ">Delivered</option>";
                echo "</select>";
                echo "</td>
                <td>";
                echo "<button type='button' class='btn btn-default' data-toggle='modal' data-target='#updateOrder$order_id'>
                                    <i class='fa-solid fa-trash'></i> Update
                        </button>";
                echo "</td>
                </tr> ";
            }
        }

        ?>
    </tbody>
</table>

<!-- Update Modal -->
<div class='modal fade' id='updateModal<?php echo $order_ ?>' tabindex='-1' role='dialog'
    aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Update Confirmation</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                Are you sure you want to update this order?
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <a href='update_order.php?order_id=<?php echo $order_id ?>' class='btn btn-danger'>Delete</a>
            </div>
        </div>
    </div>
</div>
</aside>

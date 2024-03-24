
<aside id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="row">
        <div class="myCart col-md-12">

            <h2>Cart</h2>

            <?php if (!$cart_empty) { ?>
                <table class="cart_item">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item) { ?>
                            <tr>
                                <td>
                                    <?php echo $item['product_name']; ?>
                                </td>
                                <td>
                                    <?php echo $item['quantity']; ?>
                                </td>
                                <td>
                                    <?php echo $item['price']; ?>
                                </td>
                                <td style="text-align: center;">
                                    <button class="btnRemove"
                                        onclick="removeFromCart('<?php echo $item['product_name']; ?>')"><i
                                            class="bi bi-dash-circle"></i></button>
                                </td>
                            </tr>
                            <?php
                            // Calculate subtotal for each item and add to total price
                            $subtotal = $item['price'] * $item['quantity'];
                            $totalPrice += $subtotal;
                            $_SESSION['totalPrice'] = $totalPrice;
                            ?>
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
                <div><a href="checkout.php" class="btn btn-primary btn-block">Checkout</a></div>
            <?php } else { ?>
                <p>Your cart is empty.</p>
            <?php } ?>
        </div>
    </div>
</aside>
<?php
session_start(); // Start the session

$cart_empty = false;

$totalPrice = 0; // Initialize total price variable
$totalQuantity = 0; // Initialize total quantity variable

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    $cart_empty = false;

    foreach ($cartItems as $item) {
        $totalQuantity += $item['quantity'];
    }
    $_SESSION["totalQty"] = $totalQuantity; // Update session variable for total quantity
} else {
    // If the cart is empty, display a message
    $cart_empty = true;
}

?>

<style>
.sidenav h2 {
    font-style: italic;
    text-decoration: underline;
}

.sidenav .myCart{
    padding: 25px;
}

.sidenav th, td {
    padding: 16px;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    right: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    /* color: #B2AD9A; */
    color: #bfbfbf;

}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
    color: white;
}

@media screen and (max-height: 450px) {
  .sidenav {
      padding-top: 15px;
  }
}
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" height="65px" alt="logo" title="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="product.php">Products</a>
                </li>

                <!-- OTHER LINKS -->

            </ul>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02" style="display: flex; justify-content: flex-end">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li>
                <a class="nav-link" href="user.php">
                    <h4 style="font-size: 20px; color:white; width: 100px; text-align: center; padding-top: 5px">Hi,
                        <?php echo $_SESSION["user"] ?>
                    </h4>
                </a>
            </li>
            <li>
                <a class="nav-link" href="#" style="position: relative;">
                    <img src="images/cart.png" width="40" height="40" alt="cart" onclick="openNav()" />
                    <span id="cart-quantity" style="position: absolute; top: -10px; right: -10px; border-radius: 50%; padding: 5px 8px;"><?php echo $totalQuantity; ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <img src="images/logout.png" width="40" height="40" alt="logout" />
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "450px";
        document.getElementById("main").style.marginLeft = "450px";
        document.getElementById("mySidenav").style.display = "block"; // Show the side navigation
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("mySidenav").style.display = "none"; // Hide the side navigation
    }

    function removeFromCart(productName) {
        var formData = new FormData();
        formData.append('product_name', productName);

        fetch('remove_from_cart.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                alert(data); // Show response from server
                location.reload(); // Reload the page to reflect the updated cart
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<div id="mySidenav" class="sidenav">
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
                                <td><?php echo $item['product_name']; ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td><?php echo $item['price']; ?></td>
                                <td style="text-align: center;">
                                    <button style="background-color: #B2AD9A; border-radius: 12px;" onclick="removeFromCart('<?php echo $item['product_name']; ?>')">-</button>
                                </td>
                            </tr>
                            <?php
                            // Calculate subtotal for each item and add to total price
                            $subtotal = $item['price'] * $item['quantity'];
                            $totalPrice += $subtotal;
                            ?>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Display total price -->
                <br>
                <p>Total: <?php echo '$' . number_format($totalPrice, 2); ?></p>
                <br>
                <div><a href="checkout.php" class="btn btn-primary btn-block">Checkout</a></div>
            <?php } else { ?>
                <p>Your cart is empty.</p>
            <?php } ?>
        </div>
    </div>
</div>
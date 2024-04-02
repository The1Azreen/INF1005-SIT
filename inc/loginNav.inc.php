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

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/circuitcart-logo.png" alt="Logo" height="50em">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Products</a>
                </li>
                <?php if (strcmp($_SESSION['type'], "true") == 0) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="adminpages/index.php">Admin</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto">

            <li>
                <a class="nav-link" href="user.php">
                    <span class="material-icons-outlined">person</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="#" style="position: relative;">
                    <span class="material-icons-outlined" onclick="openNav()">shopping_cart</span>
                    <span id="cart-quantity"
                        style="position: absolute; top: -10px; right: -10px; border-radius: 50%; padding: 5px 8px;">
                        <?php echo $totalQuantity; ?>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <span class="material-icons-outlined">logout</span>
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
                location.reload(); // Reload the page to show updated cart
            })


            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<?php include "cart.inc.php"; ?>
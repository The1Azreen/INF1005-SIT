<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Get product name from POST request
if (isset($_POST['product_name'])) {
    $productName = $_POST['product_name'];

    // Check if the product exists in the cart
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_name'] === $productName) {
            // Remove the item from the cart
            unset($_SESSION['cart'][$key]);
            echo 'Product removed from cart';
            exit; // Stop further execution
        }
    }
    echo 'Error: Product not found in cart';
} else {
    echo 'Error: Invalid request';
}
?>

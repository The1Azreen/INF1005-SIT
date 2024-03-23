<?php
session_start();

if (!isset ($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Get product name from POST request
// Get product name from POST request
if (isset ($_POST['product_name'])) {
    $productName = $_POST['product_name'];
    // Check if the product is already in the cart
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_name'] === $productName) {
            // If the product is already in the cart, decrement its quantity
            if ($_SESSION['cart'][$key]['quantity'] > 1) {
                $_SESSION['cart'][$key]['quantity']--; // Decrement quantity
                echo '1 '. $productName .' is removed from cart';
            } else if ($_SESSION['cart'][$key]['quantity'] = 1) {
                // If quantity becomes zero or negative, remove the item entirely
                unset($_SESSION['cart'][$key]);
                echo '1 '. $productName .' is removed from cart';
            }
            exit; // Stop further execution
        }
    }
    echo 'Error: Product not found in cart';
} else {
    echo 'Error: Invalid request';
}
?>
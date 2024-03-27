<?php
session_start();

if (!isset ($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Get product details from POST request
if (isset ($_POST['product_id'], $_POST['product_name'], $_POST['price'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];

    // Check if the product is already in the cart
    $existingCartItemKey = array_search($productId, array_column($_SESSION['cart'], 'product_id'));

    if ($existingCartItemKey !== false) {
        // If the product is already in the cart, increment its quantity
        $_SESSION['cart'][$existingCartItemKey]['quantity']++;
    } else {
        // If the product is not in the cart, add it as a new item
        $_SESSION['cart'][] = array(
            'product_id' => $productId,
            'product_name' => $productName,
            'price' => $price,
            'quantity' => 1
        );
    }

    echo $productName . ' added to cart';
} else {
    echo 'Error: Invalid request';
}
?>
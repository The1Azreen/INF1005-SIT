<!DOCTYPE html>
<html lang="en">

<head>
    <title>Iphone 11 | CircuitCart</title>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.*/dist/css/bootstrap.min.css">
    <style>
        /* Add custom styles here if needed */
    </style>
</head>

<body>
    <!--     <?php
                // Include header.inc.php for the header section
                include "inc/header.inc.php";
                ?> -->

    <?php
    // Include nav.inc.php for the navigation menu
    include "inc/nav.inc.php";
    ?>
    <div class="container mt-5">
        <div class="row">
            <!-- Product Description Column -->
            <div class="col-md-6">
                <h2 class="product-title">IPhone 11</h2>
                <p>The iPhone 11 is an exceptional smartphone that blends style, efficiency, and innovation.
                    It features a dual-camera system with 12MP Ultra Wide and Wide cameras, Night mode, Portrait mode, and 4K video up to 60fps.
                    The A13 Bionic chip provides unparalleled performance for every task while ensuring energy efficiency.
                    Its all-day battery life, coupled with the toughness of aerospace-grade aluminum and the toughest glass ever in a smartphone, offers peace of mind.
                    The iPhone 11’s 6.1-inch Liquid Retina HD display ensures everything looks stunning.</p>
                <p><strong>Technical Description:</strong></p>
                <li>Dual-Camera System: Capture wider views with the 12MP Ultra Wide camera.</li>
                <li>A13 Bionic Chip: Experience lightning-fast performance and power efficiency.</li>
                <li>All-Day Battery Life: Stay powered throughout the day with intelligent battery life.</li>
                <li>Durable Design: Aerospace-grade aluminum and the toughest glass in a smartphone.</li>
                <li>Liquid Retina Display: Immerse yourself in true-to-life colors with a 6.1-inch display.</li>
                <li>Face ID: Secure authentication and Apple Pay with just a glance.</li>
                <h3 class="price">$800.00</h3>
                <p><s>$1000</s></p>
                <div class="alert alert-warning" role="alert">
                    Note: A cancellation fee will apply. Cancellation fees may differ depending on your region.
                </div>
                <a href="/cart.php" class="btn btn-primary" role="button">Add to Cart</a>
            </div>

            <!-- Product Image Column -->
            <div class="col-md-6">
                <img src="images/product_images/Smart Phone 1.webp" alt="Image of Iphone 11" class="img-fluid">
            </div>
        </div>
    </div>

    <?php
    // Include footer.inc.php for the footer section
    include "inc/footer.inc.php";
    ?>

</body>

</html>
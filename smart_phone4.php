<!DOCTYPE html>
<html lang="en">

<head>
    <title>Samsung S24 Ultra | CircuitCart</title>
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
    <div class="container mt-5" aria-label="Product details for Samsung S24 Ultra">
        <div class="row">
            <!-- Product Description Column -->
            <div class="col-md-6">
                <h2 class="product-title">Samsung S24 Ultra</h2>
                <p>The S24 Ultra combines performance and elegance with its 6.8-inch AMOLED display and powerful octa-core processor.
                    It features a quad-camera for superior photography, long-lasting battery with fast charging, and 5G support. Built for durability with IP68 certification, it's an ideal smartphone for those who demand top-tier technology in a sleek package.</p>
                <p><strong>Technical Description:</strong></p>
                <li>Note Assist. Makes a long story short - From information overload to epic summary. Just like that.</li>
                <li>Create incredible photos with ease even in the dark and from a great distance. - Capture the night in incredible detail with Nightography Zoom. Resize and retouch photo with Photo Assist.</li>
                <li>Game-changing performance - Enjoy immersive gaming for longer, powered by Snapdragon 8 Gen 3. Enjoy optimal CPU and battery performance enhanced by our 1.9x larger Vapor Chamber</li>
                <li>A new way to discover - Circle to Search. A new way to search is here</li>
                <h3 class="price">$1750.00</h3>
                <div class="alert alert-warning" role="alert">
                    Note: A cancellation fee will apply. Cancellation fees may differ depending on your region.
                </div>
                <a href="/cart.php" class="btn btn-primary" role="button" aria-label="Add Samsung S24 Ultra to cart">Add to Cart</a>
            </div>

            <!-- Product Image Column -->
            <div class="col-md-6">
                <img src="images/product_images/Smart Phone 4.webp" alt="Image of Samsung S24 Ultra" class="img-fluid" aria-label="Image of Samsung S24 Ultra">
            </div>
        </div>
    </div>

    <?php
    // Include footer.inc.php for the footer section
    include "inc/footer.inc.php";
    ?>

</body>

</html>
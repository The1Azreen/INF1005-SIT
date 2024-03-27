<!DOCTYPE html>
<html lang="en">

<head>
    <title>Circuit Cart Product Page</title>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.*/dist/css/bootstrap.min.css">
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
    <div class="container mt-5" id="smartphones">
        <div class="row">
            <div class="py-4">
                <h2 class="text-center">Smart Phones</h2>
            </div>
            <!-- Product 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Smart Phone 1.webp" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title"><a href="smart_phone1.php" class="product-link">Iphone 11</a></h5>
                        <p class="card-text">$800.00</p>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Smart Phone 2.webp" class="product-link" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title"><a href="smart_phone2.php" class="product-link">Iphone 14 Pro Max</a></h5>
                        <p class="card-text">$1000.00</p>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Smart Phone 3.webp" class="product-link" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title"><a href="smart_phone3.php" class="product-link">Iphone 15 Pro Max</a></h5>
                        <p class="card-text">$2017.50</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5" id="monitors">
        <div class="row">
            <div class="py-4">
                <h2 class="text-center">Monitors</h2>
            </div>
            <!-- Product 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Monitor 1.webp" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title"><a href="monitor1.php" class="product-link">Dell Alienware AW3225QF</a></h5>
                        <p class="card-text">$1499.00</p>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Monitor 2.webp" class="product-link" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title"><a href="monitor2.php" class="product-link">ASUS ROG Swift OLED PG27AQDM</a></h5>
                        <p class="card-text">$1200.00</p>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Monitor 3.webp" class="product-link" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title"><a href="monitor3.php" class="product-link">LG 27GR93U-B</a></h5>
                        <p class="card-text">$1199.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5" id="headphones">
        <div class="row">
            <div class="py-4">
                <h2 class="text-center">Headphones</h2>
            </div>
            <!-- Product 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Headphone 1.webp" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title"><a href="headphone_1.php" class="product-link">Sennheiser HD 800 S</a></h5>
                        <p class="card-text">$1299.77</p>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Headphone 2.webp" class="product-link" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title"><a href="headphone_2.php" class="product-link">HiFiMan Edition XS</a></h5>
                        <p class="card-text">$379.00</p>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/product_images/Headphone 3.webp" class="product-link" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title"><a href="headphone_3.php" class="product-link">HiFiMan Sundara 2020</a></h5>
                        <p class="card-text">$299.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>

    <?php
    // Include footer.inc.php for the footer section
    include "inc/footer.inc.php";
    ?>

</body>

</html>
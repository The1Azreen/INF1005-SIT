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
    <!-- Div for Smartphone Carousel -->
    <div class="container mt-5" id="smartphones">
        <div class="py-4">
            <h2 class="text-center">Smart Phones</h2>
        </div>
        <div class="container-fluid">
            <!-- Carousel for Smart Phones -->
            <div id="smartphoneCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide 1  -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <!-- Slide 1 Product 1 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="smart_phone3.php" class="product-link">
                                        <img src="images/product_images/Smart Phone 3.webp" class="card-img-top" alt="IPhone 15 Pro Max">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="smart_phone3.php" class="product-link">IPhone 15 Pro Max</a></h5>
                                        <p class="card-text">$2017.50</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 1 Product 2 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="smart_phone4.php" class="product-link">
                                        <img src="images/product_images/Smart Phone 4.webp" class="card-img-top" alt="Samsung S24 Ultra">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="smart_phone4.php" class="product-link">Samsung S24 Ultra</a></h5>
                                        <p class="card-text">$1750.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 1 Product 3 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="smart_phone6.php" class="product-link">
                                        <img src="images/product_images/Smart Phone 6.webp" class="card-img-top" alt="OnePlus 12R">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="smart_phone6.php" class="product-link">OnePlus 12R</a></h5>
                                        <p class="card-text">$1008.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <!-- Slide 2 Product 1 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="smart_phone2.php" class="product-link">
                                        <img src="images/product_images/Smart Phone 2.webp" class="card-img-top" alt="IPhone 14 Pro Max">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="smart_phone2.php" class="product-link">IPhone 14 Pro Max</a></h5>
                                        <p class="card-text">$1000.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 Product 2 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="smart_phone5.php" class="product-link">
                                        <img src="images/product_images/Smart Phone 5.webp" class="card-img-top" alt="Nokia XR21">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="smart_phone5.php" class="product-link">Nokia XR21</a></h5>
                                        <p class="card-text">$980.000</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 Product 3 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="smart_phone1.php" class="product-link">
                                        <img src="images/product_images/Smart Phone 1.webp" class="card-img-top" alt="IPhone 11">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="smart_phone1.php" class="product-link">IPhone 11</a></h5>
                                        <p class="card-text">$600.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#smartphoneCarousel" role="button" data-slide="prev" aria-label="Previous slide of smartphones">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#smartphoneCarousel" role="button" data-slide="next" aria-label="Next slide of smartphones">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Div for Monitor Carousel -->
    <div class="container mt-5" id="monitors">
        <div class="py-4">
            <h2 class="text-center">Monitors</h2>
        </div>
        <div class="container-fluid">
            <!-- Carousel for Monitors -->
            <div id="monitorCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <!-- Slide 1 Product 1 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="monitor1.php" class="product-link">
                                        <img src="images/product_images/Monitor 1.webp" class="card-img-top" alt="Product 1">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="monitor1.php" class="product-link">Dell Alienware AW3225QF</a></h5>
                                        <p class="card-text">$1499.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 1 Product 2 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="monitor2.php" class="product-link">
                                        <img src="images/product_images/Monitor 2.webp" class="card-img-top" alt="Product 1">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="monitor2.php" class="product-link">ASUS ROG PG27AQDM</a></h5>
                                        <p class="card-text">$1200.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 1 Product 3 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="monitor3.php" class="product-link">
                                        <img src="images/product_images/Monitor 3.webp" class="card-img-top" alt="Product 1">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="monitor3.php" class="product-link">LG 27GR93U-B</a></h5>
                                        <p class="card-text">$1199.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <!-- Slide 2 Product 1 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="monitor4.php" class="product-link">
                                        <img src="images/product_images/Monitor 4.webp" class="card-img-top" alt="GIGABYTE G24F">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="monitor4.php" class="product-link">GIGABYTE G24F</a></h5>
                                        <p class="card-text">$188.69</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 Product 2 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="monitor5.php" class="product-link">
                                        <img src="images/product_images/Monitor 5.webp" class="card-img-top" alt="MSI Optix G274RW">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="monitor5.php" class="product-link">MSI Optix G274RW</a></h5>
                                        <p class="card-text">$311.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 Product 3 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="monitor6.php" class="product-link">
                                        <img src="images/product_images/Monitor 6.webp" class="card-img-top" alt="LG 27GN65R">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="monitor6.php" class="product-link">LG 27GN65R</a></h5>
                                        <p class="card-text">$289.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#monitorCarousel" role="button" data-slide="prev" aria-label="Previous slide of monitors">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#monitorCarousel" role="button" data-slide="next" aria-label="Next slide of monitors">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Div for Headphones Carousel -->
    <div class="container mt-5" id="headphones">
        <div class="py-4">
            <h2 class="text-center">Headphones</h2>
        </div>
        <div class="container-fluid">
            <!-- Carousel for Headphones -->
            <div id="headphoneCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <!-- Slide 1 Product 1 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="headphone_1.php" class="product-link">
                                        <img src="images/product_images/Headphone 1.webp" class="card-img-top" alt="Product 1">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="headphone_1.php" class="product-link">Sennheiser HD 800 S</a></h5>
                                        <p class="card-text">$1299.77</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 1 Product 2 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="headphone_2.php" class="product-link">
                                        <img src="images/product_images/Headphone 2.webp" class="card-img-top" alt="Product 1">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="headphone_2.php" class="product-link">HiFiMan Edition XS</a></h5>
                                        <p class="card-text">$379.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 1 Product 3 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="headphone_3.php" class="product-link">
                                        <img src="images/product_images/Headphone 3.webp" class="card-img-top" alt="Product 1">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="headphone_3.php" class="product-link">HiFiMan Sundara 2020</a></h5>
                                        <p class="card-text">$299.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <!-- Slide 2 Product 1 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="headphone_4.php" class="product-link">
                                        <img src="images/product_images/Headphone 4.webp" class="card-img-top" alt="Sony WH-XB910N">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="headphone_4.php" class="product-link">Sony WH-XB910N</a></h5>
                                        <p class="card-text">$275.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 Product 2 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="headphone_5.php" class="product-link">
                                        <img src="images/product_images/Headphone 5.webp" class="card-img-top" alt="JBL Live 660 NC">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="headphone_5.php" class="product-link">JBL Live 660 NC</a></h5>
                                        <p class="card-text">$199.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 Product 3 -->
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="headphone_6.php" class="product-link">
                                        <img src="images/product_images/Headphone 6.webp" class="card-img-top" alt="Marshall MAJOR IV">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="headphone_6.php" class="product-link">Marshall MAJOR IV</a></h5>
                                        <p class="card-text">$149.99</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#headphoneCarousel" role="button" data-slide="prev" aria-label="Next slide of headphones">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#headphoneCarousel" role="button" data-slide="next" aria-label="Next slide of headphones">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
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

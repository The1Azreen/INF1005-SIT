<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
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

    <main class="container">
        <!--BIG CAROUSELL-->
        <section>
            <div id="carouselBig" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselBig" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselBig" data-slide-to="1"></li>
                    <li data-target="#carouselBig" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">

                    <!--EACH CAROUSELL CARD-->
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/Banners/hugo-agut-tugal-6cdIdu8KkLg-unsplash.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block text-start">
                            <h5>BUY NOW</h>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/Banners/linkedin-sales-solutions-YDVdprpgHv4-unsplash.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/Banners/nsys-group-ZvhZBzwmLic-unsplash.jpg" alt="Third slide">
                    </div>
                </div>

                <!--ARROWS-->
                <a class="carousel-control-prev" href="#carouselBig" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselBig" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!--ARROWS-->
            </div>
        </section>

        <!--FLASH DEALS-->
        <section id="flash_deals">
            <div class="flash-deals-container">
                <div class="container-fluid bg-3 text-center">
                    <h3 class="text-center">FLASH DEALS</h3>
                    <div id="flashDealsCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#flashDealsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#flashDealsCarousel" data-slide-to="1"></li>
                            <li data-target="#flashDealsCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="images/product_images/Headphone 1.webp" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/product_images/Headphone 2.webp" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/product_images/Smart Phone 2.webp" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/product_images/Smart Phone 3.webp" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="images/product_images/Headphone 3.webp" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/product_images/Smart Phone 1.webp" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/product_images/Monitor 1.webp" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/product_images/Monitor 2.webp" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--ARROWS-->
                        <a class="carousel-control-prev" href="#flashDealsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#flashDealsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
        </section>
        <!--HOTTEST SELLING SECTION-->
    </main>


    <?php
    // Include footer.inc.php for the footer section
    include "inc/footer.inc.php";
    ?>

</body>

</html>
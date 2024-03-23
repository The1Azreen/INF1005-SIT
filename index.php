<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php // Check if user is login or not
    if (isset ($_SESSION["user"]) == "") {
        include "inc/nav.inc.php";
    } else {
        include "inc/loginNav.inc.php";
    }
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
                        <img class="d-block w-100" src="images/Banners/hugo-agut-tugal-6cdIdu8KkLg-unsplash.jpg"
                            alt="First slide">
                        <div class="carousel-caption d-none d-md-block text-center">
                            <h5>BUY NOW</h>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-100"
                            src="images/Banners/linkedin-sales-solutions-YDVdprpgHv4-unsplash.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/Banners/nsys-group-ZvhZBzwmLic-unsplash.jpg"
                            alt="Third slide">
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
            <div class="container-fluid bg-3 text-center">
                <br>
                <h3 class="text-center">FLASH DEALS</h3>
                <br>
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
                                    <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive"
                                        style="width:70%" alt="Image">
                                </div>
                                <div class="col-sm-3">
                                    <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive"
                                        style="width:70%" alt="Image">
                                </div>
                                <div class="col-sm-3">
                                    <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive"
                                        style="width:70%" alt="Image">
                                </div>
                                <div class="col-sm-3">
                                    <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive"
                                        style="width:70%" alt="Image">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="images/flash_deals/silver_laptop.jpeg" class="img-responsive"
                                        style="width:70%" alt="Image">
                                </div>
                                <div class="col-sm-3">
                                    <img src="images/flash_deals/silver_laptop.jpeg" class="img-responsive"
                                        style="width:70%" alt="Image">
                                </div>
                                <div class="col-sm-3">
                                    <img src="images/flash_deals/silver_laptop.jpeg" class="img-responsive"
                                        style="width:70%" alt="Image">
                                </div>
                                <div class="col-sm-3">
                                    <img src="images/flash_deals/silver_laptop.jpeg" class="img-responsive"
                                        style="width:70%" alt="Image">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">

                            <div class="col-sm-4">
                                <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive" style="width:70%" alt="Image">
                            </div>
                            <div class="col-sm-4">
                                <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive" style="width:70%" alt="Image">
                            </div>
                            <div class="col-sm-4">
                                <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive" style="width:70%" alt="Image">
                            </div>
                            <div class="col-sm-4">
                                <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive" style="width:70%" alt="Image">
                            </div>
                        </div> -->
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
    <br><br>
    <?php
        include "inc/footer.inc.php";
    ?>
</body>

</html>
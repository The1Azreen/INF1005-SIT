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
                    <?php
                    $carouselItems = [
                        ["images/Banners/hugo-agut-tugal-6cdIdu8KkLg-unsplash.jpg", "First slide"],
                        ["images/Banners/linkedin-sales-solutions-YDVdprpgHv4-unsplash.jpg", "Second slide"],
                        ["images/Banners/nsys-group-ZvhZBzwmLic-unsplash.jpg", "Third slide"]
                    ];

                    foreach ($carouselItems as $index => $item) {
                        $activeClass = ($index === 0) ? "active" : "";
                    ?>
                        <li data-target="#carouselBig" data-slide-to="<?php echo $index; ?>" class="<?php echo $activeClass; ?>"></li>
                    <?php } ?>
                </ol>
                <div class="carousel-inner">
                    <?php foreach ($carouselItems as $index => $item) {
                        $activeClass = ($index === 0) ? "active" : "";
                    ?>
                        <div class="carousel-item <?php echo $activeClass; ?>">
                            <img class="d-block w-100" src="<?php echo $item[0]; ?>" alt="<?php echo $item[1]; ?>">
                            <div class="carousel-caption d-none d-md-block text-start">
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <a class="carousel-control-prev" href="#carouselBig" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselBig" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>

        <section id="flash_deals">
            <div class="flash-deals-container">
                <div class="container-fluid bg-3 text-center">
                    <h3 class="text-center">FLASH DEALS</h3>
                    <div id="flashDealsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $flashDeals = [
                                ["images/flash_deals/black_digital_camera.jpeg", "Black Digital Camera"],
                                ["images/flash_deals/silver_laptop.jpeg", "Silver Laptop"],
                                ["images/flash_deals/fitness_tracker.jpeg", "Fitness Tracker"],
                                ["images/flash_deals/smart_speaker.jpeg", "Smart Speaker"],
                                ["images/flash_deals/wireless_headset.jpeg", "Wireless Headset"]
                            ];

                            $numSlides = ceil(count($flashDeals) / 4); // Calculate the number of slides

                            for ($i = 0; $i < $numSlides; $i++) {
                                $activeClass = ($i === 0) ? "active" : "";
                            ?>
                                <li data-target="#flashDealsCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $activeClass; ?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php for ($i = 0; $i < $numSlides; $i++) {
                                $activeClass = ($i === 0) ? "active" : "";
                            ?>
                                <div class="carousel-item <?php echo $activeClass; ?>">
                                    <div class="row">
                                        <?php for ($j = $i * 4; $j < min(($i + 1) * 4, count($flashDeals)); $j++) {
                                            $deal = $flashDeals[$j];
                                        ?>
                                            <div class="col-sm-3">
                                                <a href="product_description.php">
                                                    <img src="<?php echo $deal[0]; ?>" class="img-responsive" style="width:70%" alt="<?php echo $deal[1]; ?>">
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!--                         <a class="carousel-control-prev" href="#flashDealsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#flashDealsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a> -->
                        <div class="carousel-control">
                            <a class="carousel-control-prev" href="#flashDealsCarousel" role="button" data-slide="prev" style="width: 5%;">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#flashDealsCarousel" role="button" data-slide="next" style="width: 5%;">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>


    <?php
    // Include footer.inc.php for the footer section
    include "inc/footer.inc.php";
    ?>

</body>

</html>
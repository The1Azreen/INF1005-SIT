<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
</head>

<body>
<<<<<<< HEAD

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
                                        <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/flash_deals/black_digital_camera.jpeg" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="images/flash_deals/silver_laptop.jpeg" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/flash_deals/silver_laptop.jpeg" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/flash_deals/silver_laptop.jpeg" class="img-responsive" style="width:70%" alt="Image">
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="images/flash_deals/silver_laptop.jpeg" class="img-responsive" style="width:70%" alt="Image">
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
=======

<?php
// Include header.inc.php for the header section
include "inc/header.inc.php";
?>

<?php
// Include nav.inc.php for the navigation menu
include "inc/nav.inc.php";
?>

<main class="container">
    <section id="dogs">
        <h2 class="sectionheader">All About Dogs!</h2>
        <div class="row">
            <article class="col-sm">
                <h3>Poodles</h3>
                <figure>
                    <img class="img-thumbnail" src="images/poodle_small.jpg"
                         alt="Poodle" title="View larger image..."/>
                    <figcaption>Standard Poodle</figcaption>
                </figure>
                <p>
                    Poodles are a group of formal dog breeds, the Standard
                    Poodle, Miniature Poodle and Toy Poodle. The height of the poodle is typically between 18 and 24 inches,
                    although being over 15 inches specifically sets the Standard Poodle apart from Miniature Poodle and Toy Poodle.
                </p>
            </article>

            <article class="col-sm">
                <h3>Chihuahua</h3>
                <figure>
                    <img class="img-thumbnail" src="images/chihuahua_small.jpg"
                         alt="Chihuahua" title="View larger image..."/>

                    <figcaption>Chihuahua</figcaption>
                </figure>
                <p>
                    The Chihuahua is the smallest breed of dog, and is named
                    after the Mexican state of Chihuahua.There are two variables of Chihuahua - The Smooth Coat (smooth-haired)
                    and the Long Coat(long-haried). Both the Smooth and Long Coat have their special attractions and are equally
                    easy keep clean and well-groomed.
                </p>
            </article>
        </div>
    </section>

    <section id="cats">
        <h2 class="sectionheader">All About Cats!</h2>
        <div class="row">
            <article class="col-sm">
                <h3>Tabby</h3>
                <figure>
                    <img class="img-thumbnail" src="images/tabby_small.jpg"
                         alt="Tabby" title="View larger image..."/>
                    <figcaption>Tabby Cat</figcaption>
                </figure>
                <p>
                    “A tabby is any domestic cat (Felis catus) with a distinctive ‘M’ shaped marking on its forehead,
                    stripes by its eyes and across its cheeks, along its back, and around its legs and tail, and (differing by tabby type),
                    characteristic striped, dotted, lined, flecked, banded or swirled patterns on the body-neck, shoulders, sides,
                    flanks, chest and abdomen. ‘Tabby’ is not a breed of cat but a coat type seen in almost all genetic lines of domestic cats,
                    regardless of breed or pedigree status.
                </p>
            </article>

            <article class="col-sm">
                <h3>Calico</h3>
                <figure>
                    <img class="img-thumbnail" src="images/calico_small.jpg"
                         alt="Calico" title="View larger image..."/>
                    <figcaption>Calico Cat</figcaption>
                </figure>
                <p>
                    A calico cat is a domestic cat of any breed with a tri-color coat. The calico cat on its forehead,
                    stripes by its eyes and across its cheeks, along its back, and around its legs and tail, and
                    (differing by tabby type), characteristic striped, dotted, lined, flecked, banded or
                    swirled patterns on the body-neck, shoulders, sides, flanks, chest and abdomen.

                    The most commonly thought of as being typically 25% to 75% white with large orange and black patches
                    (or sometimes cream and grey patches); however, the calico cat can have any three colors in its pattern.
                    They are almost exclusively female except under rare genetic conditions. Calico is not to be confused with a
                    tortoiseshell, which has a mostly mottled coat of black/orange or grey/cream with relatively few to no
                    white markings.
                </p>
            </article>
        </div>
    </section>
</main>

<?php
// Include footer.inc.php for the footer section
include "inc/footer.inc.php";
?>

</body>
</html>
>>>>>>> parent of 0037b96 (Merge branch 'Azreen-Branch' of https://github.com/The1Azreen/INF1005-SIT into Azreen-Branch)

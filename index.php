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
    <?php // Check if user is logged in or not
    include "inc/nav.inc.php";
    ?>
    <main class="container">
        <!-- BIG CAROUSEL -->
        <section>
            <div id="carouselBig" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselBig" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselBig" data-slide-to="1"></li>
                    <li data-target="#carouselBig" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">

                    <!-- EACH CAROUSEL ITEM -->
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/Banners/hugo-agut-tugal-6cdIdu8KkLg-unsplash.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block text-center">
                            <h5>BUY NOW</h5>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/Banners/linkedin-sales-solutions-YDVdprpgHv4-unsplash.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/Banners/nsys-group-ZvhZBzwmLic-unsplash.jpg" alt="Third slide">
                    </div>
                </div>

                <!-- CAROUSEL ARROWS -->
                <a class="carousel-control-prev" href="#carouselBig" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselBig" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!-- CAROUSEL ARROWS -->
            </div>
        </section>
        <br>
        <section id="flash_deals">
            <div class="flash-deals-container">
                <div class="container-fluid bg-3 text-center">
                    <h3 class="text-center">FLASH DEALS</h3>
                    <br>
                    <div id="flashDealsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            // Fetch latest products from the database
                            $config = parse_ini_file('/var/www/private/db-config.ini');
                            if (!$config) {
                                die("Failed to read database config file.");
                            }

                            $con = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                            if ($con->connect_error) {
                                die("Connection failed: " . $con->connect_error);
                            }

                            $stmt = $con->prepare("SELECT * FROM products WHERE filePath IS NOT NULL AND filePath != '' ORDER BY product_id DESC LIMIT 8"); // Limit query to 8 latest products
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $numRows = $result->num_rows;
                            $numSlides = ceil($numRows / 4);

                            for ($i = 0; $i < $numSlides; $i++) {
                                $activeClass = ($i === 0) ? "active" : "";
                            ?>
                                <li data-target="#flashDealsCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $activeClass; ?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            // Reset result pointer
                            $result->data_seek(0);

                            // Loop through the slides
                            for ($i = 0; $i < $numSlides; $i++) {
                                echo '<div class="carousel-item' . (($i == 0) ? " active" : "") . '">';
                                echo '<div class="row">';

                                // Loop through the products for each slide
                                for ($j = 0; $j < 4; $j++) {
                                    if ($row = $result->fetch_assoc()) {
                                        $image_url = 'http://35.209.60.37/' . $row['filePath'] . '?product_id=' . $row['product_id'];
                                    ?>
                                        <div class="col-sm-3">
                                            <a href="product_description.php?product_id=<?php echo $row['product_id']; ?>">
                                                <img src="<?php echo $image_url; ?>" class="img-responsive product-image" style="width:100%" alt="<?php echo $row['product_name']; ?>">
                                            </a>
                                        </div>
                                    <?php
                                    } else {
                                        // If there are fewer than 4 products left, break out of the loop
                                        break;
                                    }
                                }

                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
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
    <br>

    <?php
    // Include footer.inc.php for the footer section
    include "inc/footer.inc.php";
    ?>

</body>

</html>

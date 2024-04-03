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

                            $stmt = $con->prepare("SELECT * FROM products ORDER BY product_id DESC LIMIT 5"); // Assuming you want to display the latest 5 products
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $numSlides = ceil($result->num_rows / 4);

                            for ($i = 0; $i < $numSlides; $i++) {
                                $activeClass = ($i === 0) ? "active" : "";
                            ?>
                                <li data-target="#flashDealsCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $activeClass; ?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $counter = 0;
                            while ($row = $result->fetch_assoc()) {
                                if ($counter % 4 == 0) {
                                    echo '<div class="carousel-item' . (($counter == 0) ? " active" : "") . '">';
                                    echo '<div class="row">';
                                }
                                $image_url = 'http://35.209.60.37/' . $row['filePath'] . '?product_id=' . $row['product_id'];
                            ?>
                                <div class="col-sm-3">
                                    <a href="product_description.php?product_id=<?php echo $row['product_id']; ?>">
                                        <img src="<?php echo $image_url; ?>" class="img-responsive product-image" style="width:70%" alt="<?php echo $row['product_name']; ?>">
                                    </a>
                                </div>
                            <?php
                                $counter++;
                                if ($counter % 4 == 0 || $counter == $result->num_rows) {
                                    echo '</div>';
                                    echo '</div>';
                                }
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

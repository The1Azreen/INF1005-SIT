<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>INF1005 Project</title>
        <?php
            include "inc/head.inc.php";
        ?>
    </head>
    <body>
        <?php // Check if user is login or not
            if (isset($_SESSION["user"]) == ""){
                include "inc/nav.inc.php";
            }
            else {
                include "inc/loginNav.inc.php";
            }
        ?>
        <main class="container">
            <!-- MAIN CONTENT -->
        </main>
        <?php
            include "inc/footer.inc.php";
        ?>
    </body>
</html>
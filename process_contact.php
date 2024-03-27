<?php

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Message Sent</title>
    <?php include "inc/head.inc.php"; ?>
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
        <div>
            <?php
            $email = $mailerrorMsg = "";
            $name = $nameerrorMsg = "";
            $mailsuccess = true;
            $namesuccess = true;
            if (empty ($_POST["email"])) {
                $mailerrorMsg .= "Email is required.<br>";
                $mailsuccess = false;
            } else {
                $email = sanitize_input($_POST["email"]);
                // Additional check to make sure e-mail address is well-formed.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mailerrorMsg = "Invalid email format.<br>";
                    $mailsuccess = false;
                }
            }
            if (empty ($_POST["name"])) {
                $nameerrorMsg .= "Email is required.<br>";
                $namesuccess = false;
            }

            if ($namesuccess && $mailsuccess) {
                ?>
                <div
                    style="padding: 20px; border-top: 2px solid #D3D3D3; margin-top: 10px; border-bottom: 2px solid #D3D3D3; margin-bottom: 10px;">
                    <h3><b>Message Sent</b></h3>
                    <h4>
                        An agent will contact you via email: <?php echo $email; ?>
                    </h4>
                    <input onclick="window.location='aboutUs.php'" class="btn btn-success"
                        value="Return to page">
                </div>
                <?php
            } else {
                ?>
                <div
                    style="padding: 20px; border-top: 2px solid #D3D3D3; margin-top: 10px; border-bottom: 2px solid #D3D3D3; margin-bottom: 10px;">
                    <h3><b>Oops!</b></h3>
                    <h4>There was an error sending your message.</h4>
                    <p>Please try again later.</p>
                    <input onclick="window.location='aboutUs.php'" class="btn btn-warning"
                        value="Return to page" />
                </div>
                <?php
            }
            ?>
        </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
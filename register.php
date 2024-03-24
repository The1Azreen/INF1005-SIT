<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Registation</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    include "inc/nav.inc.php";
    ?>
    <main class="container">
        <h1>User Registration</h1>
        <p>
            For existing user, please go to the
            <a href="login.php">Sign In page</a>.
        </p>
        <form action="process_register.php" method="post">
            <div class="mb-3">
                <label class="form-label" for="fname">First Name:</label>
                <input class="form-control" type="text" id="fname" name="fname" placeholder="Enter first name">
            </div>

            <div class="mb-3">
                <label class="form-label" maxlength="45" for="lname">Last Name:</label>
                <input required class="form-control" type="text" id="lname" name="lname" placeholder="Enter last name">
            </div>

            <div class="mb-3">
                <label class="form-label" maxlength="45" for="email">Email:</label>
                <input required class="form-control" type="email" id="email" name="email" placeholder="Enter email">
            </div>

            <div class="mb-3">
                <label class="fo rm-label" for="pwd">Password:</label>
                <input required class="form-control" type="password" id="pwd" name="pwd" placeholder="Enter password">
            </div>

            <div class="mb-3">
                <label class="form-label" for="pwd_confirm">Confirm Password:</label>
                <input required class="form-control" type="password" id="pwd_confirm" name="pwd_confirm"
                    placeholder="Confirm password">
            </div>

            <div class="mb-3 form-check">
                <input required type="checkbox" name="agree" id="agree" class="form-check-input">
                <label class="form-check-label" for="agree">
                    Agree to terms and conditions.
                </label>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Register</button>
            </div>
        </form>
    </main>
    <?php
    include "inc/footer.inc.php";
    ?>
</body>

</html>
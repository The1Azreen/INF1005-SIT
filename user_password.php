<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Password</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
    include "inc/loginNav.inc.php";
    ?>
    <br>
     <main class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Update Password</h2>
                <form action="process_password.php" method="POST">
                    <div class="mb-3">
                        <label class="fo rm-label" for="pass">Password:</label>
                        <input required class="form-control" type="password" id="pass" name="pass" placeholder="Enter password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pass_confirm">Confirm Password:</label>
                        <input required class="form-control" type="password" id="pass_confirm" name="pass_confirm" placeholder="Confirm password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                    <a href="user.php" class="btn btn-secondary">Back</a>
                </form>
                <br><br>
            </div>
        </div>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
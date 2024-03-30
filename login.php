<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Login</title>
    <?php
    include "inc/head.inc.php";
    ?>
</head>

<body>
    <?php
        include "inc/nav.inc.php";
    ?>
    <main class="container">
            <h1>User Login</h1>
            <p>
                Existing user log in here. For new user, please go to the
                <a href="register.php">user Registation page.</a>.
            </p>
            <form action="process_login.php" method="post">

                <div class="mb-3">
                    <label class="form-label" maxlength="45" for="email">Email:</label>
                    <input required class="form-control" type="email" id="email" name="email" placeholder="Enter email">
                </div>
                
                <div class="mb-3">
                    <label class="fo rm-label" for="pwd">Password:</label>
                    <input required class="form-control" type="password" id="pwd" name="pwd" placeholder="Enter password">
                </div>

                <div class="mb-3">
                <button class="btn btn-primary" type="submit">Login</button>
                </div>
                <br>
            </form>
        </main>
        <?php
            include "inc/footer.inc.php";
        ?>
    </body>
</html>
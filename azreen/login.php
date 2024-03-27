<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "inc/head.inc.php"; ?>
</head>
<body>

<?php include "inc/nav.inc.php"; ?>

<main class="container">
    <h1>Login</h1>
    <p>For New members, please go to the <a href="register.php">Sign Up page</a>.</p>
    <?php
    
    ?>
    <form action="process_login.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required maxlength="45">
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</main>

<?php include_once "inc/footer.inc.php"; ?> <!-- Include your footer file -->

</body>
</html>

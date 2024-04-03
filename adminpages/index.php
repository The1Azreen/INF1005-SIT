<?php
// Start the session to access session variables
session_start();

// Check if the 'type' session variable is set to "true"
if (!isset($_SESSION['type']) || strcmp($_SESSION['type'], "true") !== 0) {
    // If not admin, redirect to main index or login page
    header('Location: /index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../inc/head.inc.php";
    // include "adminpages/inc/header.inc.php";
    ?>
    <title>Admin Dashboard</title>
</head>

<body>
    
    <main class="container">
        <!-- Header -->
        <div class="bg-light py-3 mb-3">
            <h3 class="text-center text-success">Manage Details</h3>
        </div>

        <!-- Buttons -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-center flex-wrap">
                    <a href="index.php?view_products" class="btn btn-info mx-2 my-1">View Products</a>
                    <a href="insert_product.php" class="btn btn-info mx-2 my-1">Insert Products</a>
                    <a href="index.php?list_orders" class="btn btn-info mx-2 my-1">All Orders</a>
                    <a href="index.php?list_users" class="btn btn-info mx-2 my-1">List Users</a>
                    <a href="/index.php" class="btn btn-info mx-2 my-1">Return to Main</a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container">
            <?php
            if (isset($_GET['view_products'])) {
                include ('view_products.php');
            }
            if (isset($_GET['edit_products'])) {
                include ('edit_products.php');
            }
            if (isset($_GET['delete_product'])) {
                include ('delete_product.php');
            }
            if (isset($_GET['list_orders'])) {
                include ('list_orders.php');
            }
            if (isset($_GET['list_users'])) {
                include ('list_users.php');
            }
            ?>
        </div>

        <!-- Footer -->
        <?php
        include "../inc/footer.inc.php";
        ?>
    </main>
</body>

</html>
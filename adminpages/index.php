<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../inc/head.inc.php";
    ?>
    <title>Admin Dashboard</title>
</head>

<body>
    <main class="container">
        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 align-items-center">
            </div>
            <div class="button text-center">
                <button class="my-3"><a href="insert_product.php" class="nav-link text-light
                    bg-info my-1">Insert Products</a></button>
                <button><a href="index.php?view_products" class="nav-link text-light
                    bg-info my-1">View Products</a></button>
                <button><a href="index.php?insert_category" class="nav-link text-light
                    bg-info my-1">Insert Categories</a></button>
                <button><a href="index.php?view_categories" class="nav-link text-light
                    bg-info my-1">View Categories</a></button>
                <button><a href="index.php?insert_brand" class="nav-link text-light
                    bg-info my-1">Insert Brands</a></button>
                <button><a href="index.php?view_brands" class="nav-link text-light
                    bg-info my-1">View Brands</a></button>
                <button><a href="index.php?list_orders" class="nav-link text-light
                    bg-info my-1">All Orders</a></button>
                <button><a href="index.php?list_payments" class="nav-link text-light
                    bg-info my-1">All Payments</a></button>
                <button><a href="index.php?list_users" class="nav-link text-light
                    bg-info my-1">List Users</a></button>
                <button><a href="" class="nav-link text-light
                    bg-info my-1">Logout</a></button>
            </div>
        </div>
        </div>

        <!-- fourth child -->
        <div class="container my-3">
            <?php
            if (isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['insert_brand'])) {
                include('insert_brands.php');
            }
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if (isset($_GET['edit_products'])) {
                include('edit_products.php');
            }
            if (isset($_GET['delete_product'])) {
                include('delete_product.php');
            }
            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            if (isset($_GET['view_brands'])) {
                include('view_brands.php');
            }
            if (isset($_GET['edit_category'])) {
                include('edit_category.php');
            }
            if (isset($_GET['edit_brands'])) {
                include('edit_brands.php');
            }
            if (isset($_GET['delete_category'])) {
                include('delete_category.php');
            }
            if (isset($_GET['delete_brands'])) {
                include('delete_brands.php');
            }
            if (isset($_GET['list_orders'])) {
                include('list_orders.php');
            }
            if (isset($_GET['list_payments'])) {
                include('list_payments.php');
            }
            if (isset($_GET['list_users'])) {
                include('list_users.php');
            }
            ?>
        </div>

        <!-- last child -->
        <!-- include footer -->
        <?php
        include "../inc/footer.inc.php";
        ?>
        </div>

        <!-- bootstrap js link -->
        <!-- copy index.php js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </main>
</body>

</html>
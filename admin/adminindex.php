<!DOCTYPE html>
<html lang="en">
<head>

    <title>Admin Page testing</title>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
</head>
<body>
<?php
// Include header.inc.php for the header section
include "inc/header.inc.php";
?>

<?php
// Include nav.inc.php for the navigation menu
include "inc/nav.inc.php";
?>




<?php
// Include footer.inc.php for the footer section
include "inc/footer.inc.php";
?>
    <!--first child -->
    <div class = "container-fluid">
        <nav class = "navbar navbar-expand-lg navbar-light bg-info">
           <div class = "container-fluid">
                <img src="images/logo.jpg" alt="Logo" height="50em">
                <nav class="navbar navbar-expand-lg">
                     <ul class="navbar-nav">
                        <li class = "nav-item">
                            <a href="" class="nav-link">Welcome Admin</a>
                        </li>              
                     </ul>             
                </nav>
            </div>
        </nav>
    </div>
    <!--second child -->
    <div class = "bg-light">
            <h3 class="text-center p-2">Manage Detail</h3>
    </div>
    <!--third child -->
    <div class = "row">
            <div class="col-md-12 bg-secondary p-1">
                <div class="p-5">
                    <a href="#"><img src="../images/test.jpg d-flex align-items-center"
                    alt="" class="admin_image"></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>
                <div class="button text-center">
                    <button><a href="" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View Products</a></button>
                    <button><a href="adminindex.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View Categories</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View Brands</a></button>
                    <button><a href="adminindex.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brands</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">All Orders</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">All Payments</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">List User</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">Logout</a></button>
                </div>
            </div>
    </div>
    <!--fourth child -->
    <div class = "container my-5">
        <?php
        // Check if insert_category is pressed
        if(isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['insert_brand'])){
            include('insert_brands.php');
        }
         ?> 
    </div>
    


<?php
session_start();
// Include database configuration
include "adminpages/inc/header.inc.php";
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish connection to the database
$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<body>

<div class="container">
    <h3 class="text-center text-success">All Brands</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr class="text-center">
                <th>Serial number</th>
                <th>Brand title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $select_brands = "SELECT * FROM brands";
            $result = mysqli_query($conn, $select_brands);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $brand_id = $row['brand_id'];
                $brand_title = $row['brand_title'];
                $number++;

            ?>
                <tr class="text-center">
                    <td><?php echo $number; ?></td>
                    <td><?php echo $brand_title; ?></td>
                    <td>
                        <a href='edit_brands.php?brand_id=<?php echo $brand_id ?>' class='btn btn-warning'>
                            <i class='fa-solid fa-pen-to-square'></i> Edit
                        </a>
                    </td>
                    <td>
                        <a href='#' class='btn btn-danger' data-toggle="modal" data-target="#exampleModal<?php echo $brand_id ?>">
                            <i class='fa-solid fa-trash'></i> Delete
                        </a>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $brand_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h4>Are you sure you want to delete this?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <a href='delete_brands.php?brand_id=<?php echo $brand_id ?>' class="btn btn-primary text-light">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

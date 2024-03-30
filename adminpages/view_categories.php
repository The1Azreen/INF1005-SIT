<?php
session_start();
// Include database configuration
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h3 class="text-center text-success">All Categories</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr class="text-center">
                <th>Serial number</th>
                <th>Category title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $select_cat = "SELECT * FROM categories";
            $result = mysqli_query($conn, $select_cat);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];
                $number++;

            ?>
                <tr class="text-center">
                    <td><?php echo $number; ?></td>
                    <td><?php echo $category_title; ?></td>
                    <td>
                        <a href='edit_category.php?category_id=<?php echo $category_id ?>' class='btn btn-warning'>
                            <i class='fa-solid fa-pen-to-square'></i> Edit
                        </a>
                    </td>
                    <td>
                        <a href='delete_category.php?category_id=<?php echo $category_id ?>' class='btn btn-danger'>
                            <i class='fa-solid fa-trash'></i> Delete
                        </a>
                    </td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</div>

<!-- Include Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

<?php
// Include database configuration
include "adminpages/inc/header.inc.php";
$config = parse_ini_file('/var/www/private/db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish connection to the database
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Users</title>
    <!-- Include necessary CSS/JS libraries -->
    <?php include "adminpages/inc/head.inc.php"; ?>
</head>

<body>

    <main class="container">
        <h3 class="text-center text-success">All Users</h3>
        <table class="table table-bordered mt-5">
            <thead class="bg-info">
                <tr class="text-center">
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Account Type</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class='bg-secondary text-light'>
                <?php

                // Fetch data from the members table
                $query = "SELECT * FROM members";
                $result = mysqli_query($conn, $query);

                // Check if there are any rows returned
                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='6' class='text-center'>No users yet</td></tr>";
                } else {
                    // Iterate over the result set
                    $members = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $members[] = $row;
                    }
                    // Sort members by member_id
                    usort($members, function ($a, $b) {
                        return $a['member_id'] - $b['member_id'];
                    });
                    // Iterate over sorted members
                    foreach ($members as $row) {
                        $member_id = $row['member_id'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $email = $row['email'];
                        $acc_type = $row['acc_type'];

                        echo "<tr>
                                <td>$member_id</td>
                                <td>$fname</td>
                                <td>$lname</td>
                                <td>$email</td>
                                <td>";

                        // Only include dropdown for acc_type if it's not the first row
                        if ($member_id > 1) {
                            echo "<select class='form-control' name='acc_type'>";
                            echo "<option value='true' " . ($acc_type == 'true' ? 'selected' : '') . ">True</option>";
                            echo "<option value='false' " . ($acc_type == 'false' ? 'selected' : '') . ">False</option>";
                            echo "</select>";
                        } else {
                            // For the first row, just display the acc_type without dropdown
                            echo $acc_type;
                        }

                        echo "</td>
                              <td>";

                        // Only include the delete button for rows beyond the first one
                        if ($member_id > 1) {
                            echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal$member_id'>
                                    <i class='fa-solid fa-trash'></i> Delete
                                  </button>";
                        }
                        ?>
                        <!-- Delete Modal -->
                        <div class='modal fade' id='deleteModal<?php echo $member_id ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>Delete Confirmation</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        Are you sure you want to delete this account?
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                        <a href='delete_account.php?member_id=<?php echo $member_id ?>' class='btn btn-danger'>Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo "</td>
                              </tr>";
                    }
                }
                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <?php include "adminpages/inc/footer.inc.php"; ?>
</body>

</html>

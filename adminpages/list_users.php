<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'true') {
    // If not admin, redirect to the main index or login page
    header('Location: /index.php');
    exit();
}

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
    <!-- Include your head contents here -->
</head>
<body>
<aside>
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
            $stmt = $conn->prepare("SELECT * FROM members");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                echo "<tr><td colspan='6' class='text-center'>No users yet</td></tr>";
            } else {
                $members = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($members as $row) {
                    $member_id = htmlspecialchars($row['member_id']);
                    $fname = htmlspecialchars($row['fname']);
                    $lname = htmlspecialchars($row['lname']);
                    $email = htmlspecialchars($row['email']);
                    $acc_type = htmlspecialchars($row['acc_type']);
                    echo "<tr>
                            <td>{$member_id}</td>
                            <td>{$fname}</td>
                            <td>{$lname}</td>
                            <td>{$email}</td>
                            <td>";
                    if ($member_id > 1) { // Dropdown for members except member_id = 1
                        echo "<form method='post' action='update_acctype.php'>";
                        echo "<input type='hidden' name='member_id' value='{$member_id}'>";
                        echo "<select class='form-control' name='acc_type' onchange='this.form.submit()'>";
                        echo "<option value='true'" . ($acc_type === 'true' ? ' selected' : '') . ">True</option>";
                        echo "<option value='false'" . ($acc_type === 'false' ? ' selected' : '') . ">False</option>";
                        echo "</select>";
                        echo "</form>";
                    } else {
                        // Simply display acc_type for member_id = 1
                        echo $acc_type;
                    }
                    echo "</td>
                          <td>";
                    if ($member_id > 1) { // Only show delete button for members except member_id = 1
                        echo "<button class='btn btn-danger delete-button' data-member-id='{$member_id}'>Delete</button>";
                    }
                    echo "</td>
                          </tr>";
                }
            }
            $stmt->close();
            ?>
        </tbody>
    </table>
</aside>

<!-- Delete Confirmation Modal -->
<div id="confirmModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="delete-confirm">Yes, Delete It</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Script for Delete Confirmation Modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteButtons = document.querySelectorAll('.delete-button');
    var confirmDeleteButton = document.getElementById('delete-confirm');
    var memberIDToDelete;

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            memberIDToDelete = this.getAttribute('data-member-id');
            $('#confirmModal').modal('show');
        });
    });

    confirmDeleteButton.addEventListener('click', function () {
        // Redirect to delete script with member ID parameter
        window.location.href = 'delete_account.php?member_id=' + memberIDToDelete;
    });
});
</script>

<?php $conn->close(); ?>
</body>
</html>

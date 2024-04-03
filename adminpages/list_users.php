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
    <!-- Include your head contents here -->
    <title>All Users</title>
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
                            <td>{$acc_type}</td>
                            <td>";
                    // Only show the delete button for members that can be deleted
                    if ($member_id > 1) {
                        echo "<button type='button' class='btn btn-danger delete-btn' data-member-id='{$member_id}' data-toggle='modal' data-target='#deleteMemberModal'>
                                <i class='fa-solid fa-trash'></i> Delete
                              </button>";
                    }
                    echo "</td>
                          </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</aside>

<!-- Delete Member Modal -->
<div class="modal fade" id="deleteMemberModal" tabindex="-1" aria-labelledby="deleteMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMemberModalLabel">Confirm Member Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this member?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-btn');
    var confirmDeleteButton = document.getElementById('confirmDelete');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var memberId = this.getAttribute('data-member-id');
            confirmDeleteButton.onclick = function() {
                window.location.href = `delete_account.php?member_id=${memberId}`;
            };
        });
    });
});
</script>

<?php $conn->close(); ?>

</body>
</html>

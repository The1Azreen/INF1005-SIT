<?php
// Include database configuration
// Check if the 'type' session variable is set to "true"
if (!isset($_SESSION['type']) || strcmp($_SESSION['type'], "true") !== 0) {
    // If not admin, redirect to main index or login page
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
                    echo "<form method='post' action='update_acctype.php'>";
                    echo "<input type='hidden' name='member_id' value='{$member_id}'>";
                    echo "<select class='form-control' name='acc_type' onchange='this.form.submit()'>";
                    echo "<option value='true'" . ($acc_type === 'true' ? ' selected' : '') . ">True</option>";
                    echo "<option value='false'" . ($acc_type === 'false' ? ' selected' : '') . ">False</option>";
                    echo "</select>";
                    echo "</form>";
                    echo "</td>
                    <td>";
                    if ($member_id > 1) {
                        echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal{$member_id}'>
                                    <i class='fa-solid fa-trash'></i> Delete
                            </button>";

                    }
                    echo "</td>
                    </tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</aside>
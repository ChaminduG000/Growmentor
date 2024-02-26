<!DOCTYPE html>
<html>
<head>
    <title>Edit Permissions</title>
</head>
<body>
    <h2>Edit Permissions</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $adminId = $_POST['admin_id'];
        // In a real application, you should fetch admin data from the database.

        // Simulated admin data (replace with actual data retrieval and update).
        $admin = ["id" => $adminId, "username" => "admin1", "email" => "admin1@example.com", "permissions" => "Permission 1"];

        if ($admin) {
            echo "<form method='post' action='update_permissions.php'>";
            echo "<input type='hidden' name='admin_id' value='" . $admin['id'] . "'>";
            echo "Username: " . $admin['username'] . "<br>";
            echo "Email: " . $admin['email'] . "<br>";
            echo "Permissions: " . $admin['permissions'] . "<br>";
            echo "Update Permissions: <input type='text' name='new_permissions' value='" . $admin['permissions'] . "'>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
        } else {
            echo "Admin not found.";
        }
    }
    ?>
</body>
</html>

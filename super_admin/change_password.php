<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            background-color: #306030;
            color: #fff;
            padding: 20px;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
            padding: 20px;
        }

        input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #306030;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #3f803f;
        }

        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #306030;
            font-weight: bold;
        }

        a:hover {
            color: #3f803f;
        }
    </style>
</head>
<body>
    <h1>Change Password</h1>

    <?php
    // Database connection setup
    $db_host = "localhost"; // Update with your database host
    $db_user = "root"; // Update with your database username
    $db_pass = ""; // Update with your database password
    $db_name = "growmentor"; // Update with your database name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $admin_id = $_POST["admin_id"];
        $new_password = $_POST["new_password"];

        // Validate and sanitize user input
        $admin_id = mysqli_real_escape_string($conn, $admin_id);

        // Hash the new password using password_hash()
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the admin's password in the database using a prepared statement for security
        $update_sql = "UPDATE admin_table SET password = ? WHERE admin_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $update_sql)) {
            mysqli_stmt_bind_param($stmt, "si", $hashed_password, $admin_id);
            if (mysqli_stmt_execute($stmt)) {
                echo "Password changed successfully.";
            } else {
                echo "Error changing password: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    // If not in POST request, display the form
    $admin_id = $_GET["admin_id"];
    echo "<form method='post'>";
    echo "<input type='hidden' name='admin_id' value='" . $admin_id . "'>";
    echo "New Password: <input type='password' name='new_password' required>";
    echo "<input type='submit' value='Change Password'>";
    echo "</form>";
    ?>

    <a href="admin_panel.php">Back to Admin Management</a>
</body>
</html>

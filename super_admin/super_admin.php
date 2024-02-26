<?php
$hostname = "localhost"; // Your database hostname
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "growmentor"; // Your database name

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL statement to select the super admin by username
    $query = "SELECT * FROM super_admin WHERE username = ?";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        // Bind the username parameter
        mysqli_stmt_bind_param($stmt, 's', $username);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {
            $superAdmin = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $superAdmin['password'])) {
                // Super admin logged in successfully
                session_start();
                $_SESSION['super_admin'] = true;

                // Redirect to the super admin panel
                header('Location: admin_panel.php');
                exit();
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "Super admin not found. Please check your credentials.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the SQL statement.";
    }
}

// Close the database connection.
mysqli_close($connection);
?>

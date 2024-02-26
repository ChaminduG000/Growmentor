<?php
// Database connection setup
$db_host = "localhost"; // Update with your database host
$db_user = "root"; // Update with your database username
$db_pass = ""; // Update with your database password
$db_name = "growmentor"; // Update with your database name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate and sanitize user input
    $username = mysqli_real_escape_string($conn, $username);

    // Query the database to check admin credentials
    $sql = "SELECT * FROM admin_table WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);

        // Verify the hashed password
        if (password_verify($password, $admin['password'])) {
            // Successful login
            session_start();
            $_SESSION['admin_id'] = $admin['admin_id'];
            header("Location: dashboard.php");
        } else {
            // Invalid password
            echo "Invalid password. <a href='index.php'>Try again</a>";
        }
    } else {
        // Admin not found
        echo "Admin not found. <a href='index.php'>Try again</a>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

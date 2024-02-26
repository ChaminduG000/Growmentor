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

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // You should perform proper validation and sanitization of user input.
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert the new admin into the database
    $sql = "INSERT INTO admin_table (username, password) VALUES ('$username', '$hashedPassword')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New admin added successfully.";
        header('Location: admin_panel.php'); // Redirect to admin_panel.php
        exit; // Terminate the current script
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

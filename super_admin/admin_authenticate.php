<?php
// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'growmentor';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the entered password (use the same hashing method you used during registration)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Query the database to check if credentials are valid
$sql = "SELECT * FROM super_admin WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // User found, now verify the password
    $row = $result->fetch_assoc();
    
    if (password_verify($password, $row['password'])) {
        // Successful login
        session_start();
        $_SESSION['super_admin_username'] = $username;
        header("Location: admin_panel.php");
    } else {
        // Invalid password
        echo "Invalid password. <a href='index.html'>Try again</a>";
    }
} else {
    // User not found
    echo "Super admin not found. <a href='index.html'>Try again</a>";
}

// Close the database connection
$conn->close();
?>

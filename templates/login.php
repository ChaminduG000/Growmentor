<?php
session_start();

// Database connection
$host = "localhost"; // Your database host (usually "localhost")
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "growmentor"; // Your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Prepare and execute a query to retrieve user information
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE phone_number = ?");
    $stmt->bind_param("s", $phone_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, store user ID in session
            $_SESSION['user_id'] = $user_id;
            header("Location: index.html");
            exit;
        } else {
            echo "Invalid phone number or password.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

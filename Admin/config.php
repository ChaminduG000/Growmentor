<?php
// Database configuration
$db_host = '127.0.0.1';
$db_username = 'root';
$db_password = '';
$db_name = 'growmentor';

// Create a database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

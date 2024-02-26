<?php
session_start();

// Check if the user is logged in, and the session exists
if (!isset($_SESSION['admin_id'])) {
    // If the session doesn't exist, redirect to the login page
    header("Location: index.php");
    exit();
}

?>
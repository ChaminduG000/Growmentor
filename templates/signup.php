<?php
// Include your database connection file here if not already included

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["fname"];
    $lastName = $_POST["lname"];
    $phoneNumber = $_POST["phnNo"];
    $password = $_POST["pswd"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

    // Establish a database connection (you should have a database connection script)
    $db = new mysqli("localhost", "root", "", "growmentor");

    // Check the connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Insert data into the users table
    $sql = "INSERT INTO users (first_name, last_name, phone_number, password) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssss", $firstName, $lastName, $phoneNumber, $hashedPassword);

    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful. You can now log in.";
    } else {
        // Registration failed
        echo "Error: " . $db->error;
    }

    // Close the database connection
    $stmt->close();
    $db->close();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $phoneNumber = $_POST["phone_number"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Check if password and confirm password match
    if ($password != $confirmPassword) {
        echo "Password and confirm password do not match.";
    } else {
        // Passwords match, proceed with registration
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

        // Establish a database connection (you should have a database connection script)
        $db = new mysqli("localhost", "root", "", "growmentor");

        // Check the connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // Insert data into the users table
        $sql = "INSERT INTO users (first_name, last_name, phone_number, password) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssss", $firstName, $lastName, $phoneNumber, $hashedPassword);

        if ($stmt->execute()) {
            // Registration successful
            echo "Registration successful. You can now log in.";
        } else {
            // Registration failed
            echo "Error: " . $db->error;
        }

        // Close the database connection
        $stmt->close();
        $db->close();
    }
}
?>

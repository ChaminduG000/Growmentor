<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "growmentor";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $_POST["name"];
    $phone_number = $_POST["phone_number"];
    $message = $_POST["message"];

    // Prepare and execute SQL query to insert data into the database
    $sql = "INSERT INTO form_submissions (name, phone_number, message) VALUES ('$name', '$phone_number', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

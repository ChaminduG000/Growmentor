<?php
// Assuming you have a database connection established in your config.php
include 'config.php';

// Define the predicted class
$predictedClass = "Grape Esca (Black Measles)";

// Query the database to get treatment data based on the predicted class
$query = "SELECT treatment FROM disease_treatments WHERE class = '$predictedClass'";
$result = $conn->query($query);

$treatment = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $treatment = $row['treatment'];
}

// Close the database connection
$conn->close();
?>

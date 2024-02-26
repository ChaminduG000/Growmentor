<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $plantDisease = $_POST['plant_disease'];
    $treatment = $_POST['treatment'];
    $link1 = $_POST['link1']; // Assuming you have a form field named 'link1'

    // Insert data into the plant_disease table
    $sql = "INSERT INTO `plant_disease` (`Plant_Disease`, `Treatment`, `Link1`) VALUES ('$plantDisease', '$treatment', '$link1')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to dashboard.php with a success message parameter
        header("Location: dashboard.php?success=1");
        exit(); // Terminate script execution after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>

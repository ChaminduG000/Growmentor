<?php
// Include your database configuration here (config.php)
include 'config.php';

// Query to get the total number of diseases
$diseases_query = "SELECT COUNT(*) as total_diseases FROM plant_disease";
$diseases_result = $conn->query($diseases_query);
$total_diseases = $diseases_result->fetch_assoc()['total_diseases'];

// Create an array to hold the data
$data = array(
    'total_diseases' => $total_diseases,
);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>

<?php
// Connect to the database (replace with your database connection code)
$conn = mysqli_connect("localhost", "root", "", "growmentor");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the total number of diseases from the database
$diseaseQuery = "SELECT COUNT(*) AS total_diseases FROM diseases";
$diseaseResult = mysqli_query($conn, $diseaseQuery);

// Fetch the total number of users from the database
$userQuery = "SELECT COUNT(*) AS total_users FROM users";
$userResult = mysqli_query($conn, $userQuery);

// Process the query results and store them in an associative array
$data = array();

if (mysqli_num_rows($diseaseResult) > 0) {
    $diseaseRow = mysqli_fetch_assoc($diseaseResult);
    $data["total_diseases"] = $diseaseRow["total_diseases"];
}

if (mysqli_num_rows($userResult) > 0) {
    $userRow = mysqli_fetch_assoc($userResult);
    $data["total_users"] = $userRow["total_users"];
}

// Close the database connection
mysqli_close($conn);

// Return the statistics data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

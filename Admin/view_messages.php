<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Messages</title>
    <a class="back-button" href="dashboard.php">Back to Dashboard</a>
<style>
    .back-button {
    background-color: #306030;
    color: #fff;
    padding: 10px 20px; /* Increase padding for larger size */
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px; /* Increase font size for larger text */
    margin-top: 20px;
    display: inline-block;
    float: right; /* Align to the right */
}

.back-button:hover {
    background-color: #3f803f; /* Darker green color on hover */
}
        /* Inline CSS for demonstration purposes, consider using an external stylesheet */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/bg12.png'); /* Replace with your background image path */
            background-size: cover;
            background-blur: 10px; /* Apply a blur effect to the background */
            color: #333;
        }

        header {
            background-color: #306030;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo img {
            max-width: 100px;
            height: auto;
        }

        .header-buttons {
            display: flex;
        }

        .header-buttons .button {
            background-color: #306030;
            color: #fff;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin-left: 10px; /* Add spacing between buttons */
        }

        .header-buttons .button:hover {
            background-color: #3f803f; /* Darker green color on hover */
        }

        h2 {
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }

        .table-container {
            max-width: 1000px; /* Adjust the maximum width as needed */
            margin: 0 auto;
            overflow-x: auto; /* Enable horizontal scrolling for the table */
        }

        table {
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
            width: 100%; /* Make the table width 100% */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #306030; /* Green color for table header */
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5; /* Light gray background on hover */
        }

        /* Style the action buttons */
        form button[type="submit"] {
            padding: 6px 10px;
            background-color: #306030;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        form button[type="submit"]:hover {
            background-color: #3f803f; /* Darker green color on hover */
        }
        .back-button {
            background-color: #306030;
            color: #fff;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 20px; /* Add some top margin to separate from the table */
            display: inline-block; /* Display the button inline */
        }

        .back-button:hover {
            background-color: #3f803f; /* Darker green color on hover */
        }
    </style>
    <head>
        <title>View Messages</title>
        
<?php
// Include your database connection configuration here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "growmentor";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve form submissions
$sql = "SELECT * FROM form_submissions";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Phone Number</th><th>Message</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["phone_number"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }
    $result->close(); // Close the result set
} else {
    echo "Query failed: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Form Submissions</title>
    <!-- Add your CSS styling here if needed -->
</head>
<body>
    <h2>Form Submissions</h2>

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

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Phone Number</th><th>Message</th><th>Submission Date</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["phone_number"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "<td>" . $row["submission_date"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }

    $conn->close();
    ?>
</body>
</html>

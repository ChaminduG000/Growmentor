<!DOCTYPE html>
<html>
<head>
    <title>View Plant Diseases</title>
    <script>
        function confirmDelete(id) {
            var result = confirm("Are you sure you want to delete this record?");
            if (result) {
                // If the user clicks "Yes," submit the form
                document.getElementById('deleteForm_' + id).submit();
            } else {
                // If the user clicks "No," do nothing
            }
        }
    </script>
</head>
<body>
    <h2>View Plant Diseases</h2>
    <table>
        <tr>
            <th>Plant Disease</th>
            <th>Treatment</th>
            <th>Action</th>
        </tr>
        <?php
        // Include your database configuration here (config.php)
        include 'config.php';

        if (isset($_POST['delete'])) {
            $id = $_POST['id'];

            // SQL query to delete the record
            $sql = "DELETE FROM `plant_disease` WHERE `ID` = ?";

            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo "Record deleted successfully.";
                // Redirect back to the view page after deletion
                header("Location: view.php");
                exit();
            } else {
                echo "Error deleting record: " . $stmt->error;
            }

            $stmt->close();
        }

        $sql = "SELECT * FROM `plant_disease`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Plant_Disease'] . "</td>";
                echo "<td>" . $row['Treatment'] . "</td>";
                echo "<td>";
                echo "<form id='deleteForm_" . $row['ID'] . "' action='delete.php' method='POST'>";
                echo "<input type='hidden' name='id' value='" . $row['ID'] . "'>";
                echo "<button type='button' onclick='confirmDelete(" . $row['ID'] . ")'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <a href="add.php">Add New Plant Disease</a>
</body>
</html>

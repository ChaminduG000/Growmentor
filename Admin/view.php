<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Plant Diseases</title>
    <style>
        /* Inline CSS for demonstration purposes, consider using an external stylesheet */

        /* Common styles for all screen sizes */
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
            max-width: 100%; /* Make the table container 100% width */
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

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            th, td {
                padding: 8px; /* Reduce padding for smaller screens */
            }

            h2 {
                font-size: 20px; /* Reduce font size for smaller screens */
            }
        }
    </style>
</head>
<body>
<script>
        function confirmDelete(id) {
            // Set the data-id attribute of the delete button to the ID of the record
            document.getElementById('confirmDeleteButton').setAttribute('data-id', id);
            // Show the confirmation modal
            $('#confirmationModal').modal('show');
        }

        // Handle the delete action when the user confirms
        function deleteConfirmed() {
            // Get the ID from the data-id attribute
            var id = document.getElementById('confirmDeleteButton').getAttribute('data-id');
            // Redirect or submit the delete form with the ID
            // Example: window.location.href = 'delete.php?id=' + id;
            document.getElementById('deleteForm').action = 'delete.php?id=' + id;
            document.getElementById('deleteForm').submit();
        }
    </script>
    <header>
        <div class="logo">
            <img src="images/logo2.png" alt="Company Logo">
        </div>
        <h2>Growmentor | View Disease And Treatment</h2>
        <div class="header-buttons">
            <a href="logout.php" class="button">Logout</a>
            <a href="javascript:history.back()" class="button">Back</a>
        </div>
    </header>
   <br>
    <div class="table-container">
        <table>
            <tr>
                <th>No</th>
                <th>Plant Disease</th>
                <th>Treatment</th>
                <th>Link</th>
                <th></th>
                <th>Action</th>
            </tr>
            <?php
        // Include your database configuration here (config.php)
        include 'config.php';

        $sql = "SELECT * FROM `plant_disease`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['Plant_Disease'] . "</td>";
                echo "<td>" . $row['Treatment'] . "</td>";
                echo "<td>" . $row['Link1'] . "</td>";
               
                echo "<td>";
                echo "<form action='edit.php' method='POST'>";
                echo "<input type='hidden' name='id' value='" . $row['ID'] . "'>";
                echo "<button type='submit'>Edit</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form action='delete.php' method='POST' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='id' value='" . $row['ID'] . "'>";
                echo "<button type='submit' name='delete'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        
        // JavaScript function for confirmation
        echo "<script>
                function confirmDelete() {
                    return confirm('Are you sure you want to delete this record?');
                }
              </script>";

        $conn->close();
        ?>
    </table>
</body>
</html>




        
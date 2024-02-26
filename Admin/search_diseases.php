<?php
// Include your database configuration here (config.php)
include 'config.php';

$searchTerm = $_GET['search'];

// Query to fetch diseases based on the search term
$sql = "SELECT * FROM `plant_disease` WHERE `Plant_Disease` LIKE '%$searchTerm%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>No</th>
            <th>Plant Disease</th>
            <th>Treatment</th>
            <th>Link</th>
            <th></th>
            <th>Action</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['Plant_Disease'] . "</td>";
        echo "<td>" . $row['Treatment'] . "</td>";
        echo "<td>" . $row['Link1'] . "</td>";
        echo "<td>
                <form action='edit.php' method='POST'>
                    <input type='hidden' name='id' value='" . $row['ID'] . "'>
                    <button type='submit'>Edit</button>
                </form>
              </td>";
        echo "<td>
                <form action='delete.php' method='POST' onsubmit='return confirmDelete()'>
                    <input type='hidden' name='id' value='" . $row['ID'] . "'>
                    <button type='submit' name='delete'>Delete</button>
                </form>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No records found</p>";
}

$conn->close();
?>

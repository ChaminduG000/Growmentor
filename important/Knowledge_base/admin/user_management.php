<?php
include 'db_connection.php';

// Function to delete user
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    // Proceed with user deletion
    $sql_delete_posts = "DELETE FROM posts WHERE post_by = $user_id";
    $conn->query($sql_delete_posts);

    $sql_delete_friendships = "DELETE FROM friendship WHERE user1_id = $user_id OR user2_id = $user_id";
    $conn->query($sql_delete_friendships);

    $sql_delete_user = "DELETE FROM users WHERE user_id = $user_id";
    $conn->query($sql_delete_user);
    echo "User deleted successfully.";
}

// List Users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>User Management</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userId = $row["user_id"];
                $userName = $row["user_firstname"] . " " . $row["user_lastname"];

                echo "<tr>";
                echo "<td>$userId</td>";
                echo "<td>$userName</td>";
                echo "<td>";
                echo "<form method='post' action='user_management.php'>";
                echo "<input type='hidden' name='user_id' value='$userId'>";
                echo "<button type='submit' name='delete_user'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>

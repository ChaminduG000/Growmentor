<?php
include('session.php');
// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "growmentor";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to delete user
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    // Check if a confirmation has been sent
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
        // Proceed with user deletion
        $sql_delete_posts = "DELETE FROM posts WHERE post_by = $user_id";
        $conn->query($sql_delete_posts);

        $sql_delete_friendships = "DELETE FROM friendship WHERE user1_id = $user_id OR user2_id = $user_id";
        $conn->query($sql_delete_friendships);

        $sql_delete_user = "DELETE FROM users WHERE user_id = $user_id";
        $conn->query($sql_delete_user);
        echo "User deleted successfully.";
    } else {
        // Display a confirmation dialog
        echo "Are you sure you want to delete this user?<br>";
        echo "<form method='post' action='user_management.php'>";
        echo "<input type='hidden' name='user_id' value='$user_id'>";
        echo "<input type='hidden' name='confirm_delete' value='yes'>";
        echo "<button type='submit' name='delete_user'>Yes, Delete</button>";
        echo "<button type='button' onclick='window.history.back()'>Cancel</button>";
        echo "</form>";
    }
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
<header>
    <div class="logo">
        <img src="images/logo2.png" alt="Logo">
    </div>
    <div class="header-buttons">
        <a class="button" href="javascript:history.back()">Back</a>
    </div>
</header>
    <h2>Knowledge Hub | User Management</h2>
    <div class="table-container">
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
                    $userName = $row["first_name"] . " " . $row["last_name"];
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
    </div>
</body>
</html>

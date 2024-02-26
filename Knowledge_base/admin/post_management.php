<?php
include 'db_connection.php';

// Function to delete post
if (isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];
    $sql = "DELETE FROM posts WHERE post_id = $post_id";
    $conn->query($sql);
}

// List Posts
$sql = "SELECT p.*, u.user_firstname, u.user_lastname FROM posts p
        JOIN users u ON p.post_by = u.user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Management</title>
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

        h1 {
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
            text-align: center;
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

            h1 {
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
    <h1>Post Management</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>Post ID</th>
                <th>Caption</th>
                <th>Post Time</th>
                <th>Public</th>
                <th>Posted By</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $postId = $row["post_id"];
                    $caption = $row["post_caption"];
                    $postTime = $row["post_time"];
                    $isPublic = $row["post_public"] == 'Y' ? "Yes" : "No";
                    $userName = $row["user_firstname"] . " " . $row["user_lastname"];

                    echo "<tr>";
                    echo "<td>$postId</td>";
                    echo "<td>$caption</td>";
                    echo "<td>$postTime</td>";
                    echo "<td>$isPublic</td>";
                    echo "<td>$userName</td>";
                    echo "<td>";
                    echo "<form method='post' action='post_management.php'>";
                    echo "<input type='hidden' name='post_id' value='$postId'>";
                    echo "<button type='submit' name='delete_post'>Delete</button>";
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

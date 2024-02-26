<!DOCTYPE html>
<html>
<head>

    <title>Admin Management</title>
    
    <style>
        /* Inline CSS for demonstration purposes, consider using an external stylesheet */
 /* Your provided CSS styles */
 body {
        background-image: url('images/homebg.jpg');
        background-size: cover;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden;
        backdrop-filter: blur(4px); /* Apply a blur effect to the background */
    }

    .login-container {
        background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
        padding: 10px;
        border-radius: 10px;
        width: 500px;
        backdrop-filter: blur(10px); /* Apply a blur effect to the background */
        /* Adjust the height as per your requirements */
        height: 300px; /* Adjust the height to your desired value */
    }

    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    button {
        padding: 10px;
        background-color: #006400;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #195905; /* Change the background color on hover */
    }
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
            padding: 5px;
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
        .logout-button {
    padding: 10px;
    background-color: #006400; /* Green background color */
    color: #fff; /* White text color */
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none; /* Remove underlines from the link */
    display: inline-block; /* Make the link a block element for styling */
    margin-right: 10px; /* Add spacing between buttons */
}

.logout-button:hover {
    background-color: #195905; /* Darker green color on hover */
}
.table-container {
            max-width: 100%;
            overflow-x: auto;
            max-height: 400px; /* Set the maximum height as per your requirements */
        }
        .success-message {
            color: green;
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            background-color: rgba(225, 255, 225, 225);
        }
        .action-button {
        padding: 6px 10px;
        background-color: #306030;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 5px; /* Add spacing between buttons */
    }

    .action-button:hover {
        background-color: #3f803f; /* Darker green color on hover */
    }
    </style>
</head>

<body>
    
<div id="success-messages"></div>
    <?php
    if (isset($_SESSION['success_message'])) {
        echo $_SESSION['success_message'];
        unset($_SESSION['success_message']); // Clear the success message
    }
    
    ?>
</div>
    <h2><font color="white">Growmentor Super Admin | Admin Management</h2></font>
    
    <nav>
    <div class="login-container">
    <h2>Add New Admin</h2>
    <form action="add_admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Add Admin</button>
    </form>
   
    </nav>
<br>
<h3><font color="white">Manage Admin </h3></font>
    <?php
  
    // Database connection setup
    $db_host = "localhost"; // Update with your database host
    $db_user = "root"; // Update with your database username
    $db_pass = ""; // Update with your database password
    $db_name = "growmentor"; // Update with your database name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Handle delete action
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['admin_id'])) {
        $admin_id = $_GET['admin_id'];

        // Use prepared statements to prevent SQL injection
        $delete_sql = "DELETE FROM admin_table WHERE admin_id = ?";
        $stmt = mysqli_prepare($conn, $delete_sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $admin_id); // "i" indicates an integer
            if (mysqli_stmt_execute($stmt)) {
                echo '<p class="success-message">Admin user deleted successfully.</p>';

            } else {
                echo "Error deleting admin user: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error in prepared statement: " . mysqli_error($conn);
        }
    }

    // Display admin records
    $sql = "SELECT * FROM admin_table";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="table-container">';
            echo '<table border="1">';
            echo '<tr><th>Admin ID</th><th>Username</th><th>Password</th><th></th><th>action</th></tr>';

            $row_count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['admin_id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['password'] . '</td>';
                echo '<td>';

                echo '<td>';
                echo '<a href="admin_panel.php?action=delete&admin_id=' . $row['admin_id'] . '" onclick="return confirm(\'Are you sure you want to delete this admin?\');" class="action-button">Delete</a>';
                
                echo '<a href="change_password.php?admin_id=' . $row['admin_id'] . '" class="action-button">Change Password</a>';
                echo '</td>';
                echo '</tr>';
                
                $row_count++;

                // Show only 4 rows initially, the rest will be scrollable
                if ($row_count >= 1000) {
                    break;
                }
            }

            echo '</table>';
            echo '</div>';
        } else {
            echo "No admin records found.";
        }
        mysqli_free_result($result);
    } else {
        echo "Error in SQL query: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    ?>
    
<script>
    // Function to remove the success message after 3 seconds
    function removeSuccessMessage() {
        var successMessage = document.querySelector('.success-message');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 3000); // 3000 milliseconds (3 seconds)
        }
    }

    // Call the function when the page loads
    window.onload = removeSuccessMessage;

    // Check if there's a success message and display it
    var successMessage = document.querySelector('.success-message');
    if (successMessage) {
        successMessage.style.display = 'block'; // Display the success message
    }
</script><br>
<a href="logout.php" class="logout-button">Logout</a>

   
    </div>
</body>
</html>

<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Retrieve the record based on the ID
    $sql = "SELECT * FROM `plant_disease` WHERE `ID`='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Close the connection to avoid conflicts with subsequent queries
        $conn->close();
    } else {
        echo "Record not found";
        exit;
    }
} else {
    echo "Invalid request";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Plant Disease</title>
    <!-- Add your CSS stylesheets or use a CSS framework here -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional CSS for the edit form section */
        body {
            background-image: url('images/bg12.png'); /* Replace 'background.jpg' with your background image URL */
            background-size: cover;
            background-blur: blur(5px); /* Add a blur effect to the background */
            background-attachment: fixed; /* Fixed background to prevent scrolling */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #306030;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            max-width: 100px;
            height: auto;
        }

        .title h1 {
            margin: 0;
            font-size: 24px;
        }

        nav ul {
            list-style: none;
            background-color: #306030;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* Style for the logout button */
        nav ul li a.logout-button {
            background-color: #2e8b57; /* Red color */
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        nav ul li a.logout-button:hover {
            background-color: #4f7942; /* Darker red color on hover */
            text-decoration: none;
        }

        #edit {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #edit h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        #edit label {
            font-weight: bold;
            font-size: 18px;
        }

        #edit input[type="text"],
        #edit textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #edit button[type="submit"] {
            padding: 10px 20px;
            background-color: #306030;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        #edit button[type="submit"]:hover {
            background-color: #3f803f;
        }

        footer {
            background-color: #306030;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #fff;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo2.png" alt="Company Logo">
        </div>
        <div class="title">
            <h1>Growmentor | Edit Plant Disease</h1>
        </div>
        <nav>
            <ul>
                <li><a href="view.php">Manage Plant Diseases</a></li>
                <li><a href="logout.php" class="logout-button">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="edit">
        <h2>Edit Plant Disease</h2>
        <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
        <label for="plant_disease">Plant Disease:</label>
        <input type="text" id="plant_disease" name="plant_disease" value="<?php echo $row['Plant_Disease']; ?>" required><br>

        <label for="treatment">Treatment:</label>
        <textarea id="treatment" name="treatment" rows="8" cols="30" required><?php echo $row['Treatment']; ?></textarea><br>
        
        <label for="link1">Link1:</label>
        <input type="text" id="link1" name="link1" value="<?php echo $row['Link1']; ?>"><br>

        <button type="submit">Update Disease</button>
    </form>
    </section>
<br><br>
    <footer>
        <p>&copy; 2023 Growmentor</p>
    </footer>
</body>
</html>

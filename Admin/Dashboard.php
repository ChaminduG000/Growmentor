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

// Initialize the success flag as false
$successFlag = false;

// Check if a new disease is being added
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['plant_disease']) && isset($_POST['treatment'])) {
        $plantDisease = $_POST['plant_disease'];
        $treatment = $_POST['treatment'];

        // Insert the new disease into the database
        $insertQuery = "INSERT INTO plant_disease (disease_name, treatment) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ss", $plantDisease, $treatment);

        if ($stmt->execute()) {
            // Set the success flag to true if the insertion is successful
            $successFlag = true;
        }
    }
}

// Query to count users
$userCountQuery = "SELECT COUNT(*) AS user_count FROM users";
$userCountResult = $conn->query($userCountQuery);

// Query to count diseases
$diseaseCountQuery = "SELECT COUNT(*) AS disease_count FROM plant_disease";
$diseaseCountResult = $conn->query($diseaseCountQuery);

// Check if the queries were successful
if ($userCountResult && $diseaseCountResult) {
    $userCount = $userCountResult->fetch_assoc()["user_count"];
    $diseaseCount = $diseaseCountResult->fetch_assoc()["disease_count"];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plant Disease Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* Inline CSS for demonstration purposes, consider using an external stylesheet */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/bg12.png'); /* Replace with your background image URL */
            background-size: cover;
            backdrop-filter: blur(5px); /* Add a blur effect to the background */
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

        /* Style for the logout button */
        nav ul li a.logout-button {
            background-color: #2e8b57; /* Green color */
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        nav ul li a.logout-button:hover {
            background-color: #4f7942; /* Darker green color on hover */
            text-decoration: none;
        }

        .dashboard {
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
            padding: 20px;
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
        }

        .dashboard h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .dashboard-stat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        .dashboard-stat .label {
            font-weight: bold;
            font-size: 18px;
        }

        .dashboard-stat .value {
            font-size: 24px;
        }

        .dashboard-item {
            display: flex;
            align-items: center;
        }

        .dashboard-icon {
            max-width: 50px; /* Adjust the width as needed */
            height: auto;
            margin-right: 10px; /* Add some spacing between the icon and content */
        }

        .dashboard-content {
            flex: 1; /* Allow the content to take up remaining space */
        }

        .section-button {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .section-button button {
            background-color: #fff;
            color: #306030;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        }

        .section-button button i {
            font-size: 24px; /* Adjust icon size */
            margin-bottom: 10px; /* Add space between icon and text */
        }

        .section-button button:hover {
            background-color: #306030;
            color: #fff;
            transform: scale(1.05);
        }

        section {
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
            padding: 20px;
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
        }

        /* Style for form elements */
        form label {
            font-weight: bold;
            font-size: 18px;
        }

        form input[type="text"],
        form textarea {
            width: 96%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        form button[type="submit"] {
            padding: 10px 20px;
            background-color: #306030; /* Green color */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        form button[type="submit"]:hover {
            background-color: #3f803f; /* Darker green color on hover */
        }

        footer {
            background-color: #306030;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #fff; /* Add a border on top for separation */
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="images/logo2.png" alt="Company Logo">
    </div>
    <div class="title">
        <h1>Growmentor | Admin Dashboard</h1>
    </div>
    <nav>
        <ul>
            <li><i class="fas fa-user"></i> <?php echo "Admin"; ?></li>
            <li><a href="logout.php" class="logout-button">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="dashboard">
    <h2>Dashboard</h2>
    <div class="dashboard-stat">
        <div class="dashboard-item">
            <img src="images/ds.png" alt="Disease Icon" class="dashboard-icon">
            <div class="dashboard-content">
                <div class="label">Total Diseases Added</div>
                <div class="value"><?php echo $diseaseCount; ?></div>
            </div>
        </div>
    </div>
    <div class="dashboard-stat">
        <div class="dashboard-item">
            <img src="images/users.png" alt="User Icon" class="dashboard-icon">
            <div class="dashboard-content">
                <div class="label">Total Users Joined</div>
                <div class="value"><?php echo $userCount; ?></div>
            </div>
        </div>
    </div>
</div>

<div class="horizontal-sections">
<section class="section">
    <h2>Add Plant Disease and Treatment</h2>
    <form action="insert.php" method="POST">
        <label for="plant_disease">Plant Disease:</label>
        <input type="text" id="plant_disease" name="plant_disease" required><br>

        <label for="treatment">Treatment:</label>
        <textarea id="treatment" name="treatment" rows="8" cols="30" style="width: 96%;" required></textarea><br>

        <label for="link1">Links:</label>
        <input type="text" id="link1" name="link1"><br>

        <button type="submit">Add Disease</button>
    </form>
</section>

<section class="section">
    <center>
        <h2>Manage Growmentor</h2>
        <div class="section-button">
            <div class="button-row">
                <button class="manage-button" onclick="handleManagePlantDiseases()">
                    <br><i class="fas fa-leaf"></i> Manage Plant Diseases
                </button>
                <button class="manage-button" onclick="handleManageUsers()">
                <br><i class="fas fa-users"></i> Manage Users
                </button>
            </div>
            <div class="button-row">
                <button class="manage-button" onclick="handleManagePosts()">
                <br><i class="fas fa-file-alt"></i> Manage Posts
                </button>
                <button class="manage-button" onclick="handleViewMessages()">
                <br><i class="fas fa-envelope"></i> View Messages
                </button>
            </div>
        </div>
    </center>
</section>

    
</div>

<style>
    .horizontal-sections {
        display: flex;
        justify-content: space-between; /* Adjust as needed */
    }

    .section {
        width: 48%; /* Set the width to 48% to leave some space between the sections */
        padding: 20px; /* Add padding for spacing and aesthetics */
        box-sizing: border-box; /* Include padding in the width calculation */
    }

    .manage-button {
        width: 100%;
        margin-bottom: 10px;
        background-color: #2e8b57; /* Change to your desired background color */
        color: #fff; /* Change to your desired font color */
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
    }

    .manage-button:hover {
        background-color: #4f7942; /* Change to the hover color you prefer */
    }
    /* Add this to your existing CSS */
    .manage-button {
    height: 150px; /* Adjust the height as needed */
    /* Add other styles if needed */
}

.section-button {
    display: flex;
    flex-direction: column;
}

.button-row {
    display: flex;
    justify-content: space-around;
    margin-bottom: 10px; /* Adjust as needed for spacing between rows */
}

</style>



<footer>
    <p>&copy; 2023 Growmentor</p>
</footer>

<script>
    function handleManageUsers() {
        // Redirect to the manage users page
        window.location.href = "user_management.php"; // Replace with the actual URL
    }

    function handleManagePosts() {
        // Redirect to the manage posts page
        window.location.href = "post_management.php"; // Replace with the actual URL
    }

    function handleViewMessages() {
        // Redirect to the manage users page
        window.location.href = "view_messages.php"; // Replace with the actual URL
    }

    function handleManagePlantDiseases() {
        // Redirect to the manage posts page
        window.location.href = "view.php"; // Replace with the actual URL
    }
</script>

<?php if ($successFlag): ?>
    <div class="success-message" id="successMessage">
        <center>New disease record created successfully!</center>
    </div>
<?php endif; ?>

</body>
</html>

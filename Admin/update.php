<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $plantDisease = $_POST['plant_disease'];
    $treatment = $_POST['treatment'];
    $link1 = $_POST['link1']; // Add the Link1 field

    // Update the record in the database
    $sql = "UPDATE `plant_disease` SET `Plant_Disease`='$plantDisease', `Treatment`='$treatment', `Link1`='$link1' WHERE `ID`='$id'";

    if ($conn->query($sql) === TRUE) {
        // Success! Redirect to the view page with a success message
        header("Location: view.php?success=1");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Redirect to the edit page if accessed without a POST request
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    header("Location: edit.php?id=" . $_POST['id']);
} else {
    echo "Invalid request";
}


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM `plant_disease` WHERE `ID`='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found";
        exit;
    }
} else {
    echo "Invalid or missing ID";
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Plant Disease</title>
    <!-- Add your CSS stylesheets or use a CSS framework here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <!-- Header content (same as your dashboard header) -->
    </header>

    <nav>
        <!-- Navigation menu (same as your dashboard navigation) -->
    </nav>

    <section id="edit">
    <h2>Edit Plant Disease</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
        <label for="plant_disease">Plant Disease:</label>
        <input type="text" id="plant_disease" name="plant_disease" value="<?php echo $row['Plant_Disease']; ?>" required><br>

        <label for="treatment">Treatment:</label>
        <textarea id="treatment" name="treatment" rows="8" cols="30" required><?php echo $row['Treatment']; ?></textarea><br>
        
        <label for="link1">Link:</label>
        <input type="text" id="link1" name="link1" value="<?php echo $row['Link1']; ?>"><br>

        <button type="submit">Update Disease</button>
    </form>
</section>

    <!-- Footer (same as your dashboard footer) -->

</body>
</html>

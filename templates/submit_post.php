<?php
// Include database connection file
include('config.php');

// Initialize session
session_start();

// Check if the user is not logged in, redirect to login.php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Process post form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $post_caption = mysqli_real_escape_string($conn, $_POST['post_caption']);
    $post_public = mysqli_real_escape_string($conn, $_POST['post_public']);
    $post_by = mysqli_real_escape_string($conn, $_POST['post_by']);

    // Check if a file was uploaded
    if (isset($_FILES['post_photo']) && $_FILES['post_photo']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['post_photo']['tmp_name'];
        $filename = basename($_FILES['post_photo']['name']);
        $upload_path = 'uploads/' . $filename;

        // Create the 'uploads' directory if it doesn't exist
        if (!is_dir('uploads')) {
            mkdir('uploads');
        }

        // Move the uploaded file to the uploads directory
        if (!move_uploaded_file($tmp_name, $upload_path)) {
            echo "Error moving the uploaded file.";
            exit();
        }
    } else {
        $filename = ''; // Set default value if no file is uploaded
    }

    // Insert the post into the database, including the photo filename
    $query = "INSERT INTO posts (post_caption, post_public, post_by, post_photo) 
              VALUES ('$post_caption', '$post_public', '$post_by', '$filename')";
    mysqli_query($conn, $query);
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the main page
header('Location: index.php');
exit();
?>

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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the form
    $post_caption = $_POST['post_caption'];
    $post_public = isset($_POST['post_public']) && $_POST['post_public'] === 'Y' ? 'Y' : 'N';
    $post_by = $_SESSION['user_id'];

    // Your existing code to handle file upload, if any

    // Insert the post into the database
    $insert_query = "INSERT INTO posts (post_caption, post_public, post_by) VALUES ('$post_caption', '$post_public', $post_by)";
    mysqli_query($conn, $insert_query);
}

// Fetch all posts from the database
$query = "SELECT * FROM posts 
          JOIN users ON posts.post_by = users.user_id
          WHERE posts.post_public = 'Y' OR users.user_id = {$_SESSION['user_id']} 
          ORDER BY post_time DESC";

$result = mysqli_query($conn, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed</title>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <div class="mainWrapper sticky navbar" id="main">
        <div class="centerWrapper" id="center">
            <div class="leftWrapper" id="left">
                <div class="navLogo" id="logoNav">
                    <a href="#home">
                        <img src="Images/navLogo.PNG" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
    <!-- Display user information -->
    <p style="margin-top:4%;margin-left:10%;">Logged in as: <?php echo $_SESSION['user_id']; ?> | <a class="logOutBackBtn" href="#">Back</a> <a class="logOutBackBtn" href="logout.php">Logout</a></p>

    <!-- Form to submit new posts with photo -->
    <h2 style="margin-top:5%;text-align:center;">Share Your Knowledge with Others</h2>
    <form action="submit_post.php" method="post" enctype="multipart/form-data">
        <label for="post_caption">Share Your Knowledge</label>
        <textarea id="post_caption" name="post_caption" rows="10" cols="50" required></textarea><br>

        <!-- File input for photo upload -->
        <label for="post_photo">Upload Photo:</label>
        <input type="file" id="post_photo" name="post_photo"><br>

        <!-- Use the logged-in user's ID as the post_by value -->
        <input type="hidden" name="post_by" value="<?php echo $_SESSION['user_id']; ?>">

        <button type="submit" style="margin-top:10px">Submit Post</button>
    </form>
    </div>
    <h1 style="text-align:center; margin-top:5%;">Welcome to the News Feed</h1>
    <!-- Display posts -->
    <?php foreach ($posts as $post) : ?>
        <div>
            <p style="margin-left:10%;">Posted by: <?php echo $post['first_name'] . ' ' . $post['last_name']; ?></p>
            <p style="margin-left:10%;">News: <?php echo $post['post_caption']; ?></p>
            <p style="margin-left:10%;">Posted on: <?php echo $post['post_time']; ?></p>

            <!-- Display the uploaded photo if available -->
            <?php if (!empty($post['post_photo'])) : ?>
                <img src="uploads<?php echo $post['post_photo']; ?>" alt="Post Photo" style="max-width: 300px; max-height: 300px;">
            <?php endif; ?>

            <hr>
        </div>
    <?php endforeach; ?>
</body>
<footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2023 by GrowMentor | All Right Reserved</p>
            <p>- Contact Us for more details -</p>
            <a href="#" style="text-decoration:none; color:white; cursor:pointor;">GrowMentor</a> 
            <p>Grow Mentor News Feed</p>
        </div>
    </footer>
</html>

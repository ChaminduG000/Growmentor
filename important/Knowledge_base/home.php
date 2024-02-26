<?php 
require 'functions/functions.php';
session_start();

// Check whether the user is logged in or not
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}

$temp = $_SESSION['user_id'];
session_destroy();
session_start();
$_SESSION['user_id'] = $temp;
ob_start(); 

// Establish Database Connection
$conn = connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Growmentor | Knowledge Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./home.css">
    <style>
        /* Your custom CSS styles here */
        
        /* Justify all content */
        .justify-content {
            text-align: justify;
        }
    </style>
</head>
<body class="justify-content">
<?php include 'includes/navbar.php'; ?>
<div class="container" id="bg">   
    <div class="createpost d-flex justify-content-center p-4 text-center border-2 mt-4" style="height: 700px;">
        <form class="container" method="post" action="" onsubmit="return validatePost()" enctype="multipart/form-data">
            <h2><b>Share Your Knowledge</b></h2>
            <span style="float:right; color:black">
                <input type="checkbox" id="public" name="public">
                <label for="public">Public</label>
            </span>
            <span class="required" style="color:red; font-weight:bold;"><i class='bx bx-error-circle'></i> You can't Leave the Caption Empty</span><br>
            <textarea cols="30" rows="10" placeholder="Suggest tips and treatments for plant growth and disease control" class="inputContact3 w-75 border border-2 p-2" name="caption"></textarea>
            <center><img src="" id="preview" style="max-width:10rem; border:2px solid #020f04a0; display:none;"></center>
            <div class="createpostbuttons">
                <label class="upld container mt-4">
                    <img src="images/phto.png" style="width: 5rem;">
                    <input type="file" name="fileUpload" id="imagefile">
                </label>
                <br>
                <input class="mt-4 btn btn-primary" type="submit" value="Share" name="post">
            </div>
        </form>
    </div>
    
    <h1 class="text-center m-4"><b>News Feed</b></h1>
    <?php 
    // Public Posts Union Friends' Private Posts
    $sql = "SELECT posts.post_caption, posts.post_time, posts.post_public, users.user_firstname,
                    users.user_lastname, users.user_id, users.user_gender, posts.post_id
            FROM posts
            JOIN users
            ON posts.post_by = users.user_id
            WHERE posts.post_public = 'Y' OR users.user_id = {$_SESSION['user_id']}
            UNION
            SELECT posts.post_caption, posts.post_time, posts.post_public, users.user_firstname,
                    users.user_lastname, users.user_id, users.user_gender, posts.post_id
            FROM posts
            JOIN users
            ON posts.post_by = users.user_id
            JOIN (
                SELECT friendship.user1_id AS user_id
                FROM friendship
                WHERE friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 1
                UNION
                SELECT friendship.user2_id AS user_id
                FROM friendship
                WHERE friendship.user1_id = {$_SESSION['user_id']} AND friendship.friendship_status = 1
            ) userfriends
            ON userfriends.user_id = posts.post_by
            WHERE posts.post_public = 'N'
            ORDER BY post_time DESC";

    $query = mysqli_query($conn, $sql);
    if(!$query){
        echo mysqli_error($conn);
    }
    if(mysqli_num_rows($query) == 0){
        echo '<div class="post">';
        echo 'There are no posts yet to show.';
        echo '</div>';
    }
    else{
        $width = '40px'; // Profile Image Dimensions
        $height = '40px';
        while($row = mysqli_fetch_assoc($query)){
            include 'includes/post.php';
            echo '<br>';
        }
    }
    ?>
    <br><br><br>
</div>

<script src="resources/js/jquery.js"></script>
<script>
    // Invoke preview when an image file is chosen.
    $(document).ready(function(){
        $('#imagefile').change(function(){
            preview(this);
        });
    });
    
    // Preview function
    function preview(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (event){
                $('#preview').attr('src', event.target.result);
                $('#preview').css('display', 'initial');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    // Form Validation
    function validatePost(){
        var required = document.getElementsByClassName("required");
        var caption = document.getElementsByTagName("textarea")[0].value;
        required[0].style.display = "none";
        if(caption == ""){
            required[0].style.display = "initial";
            return false;
        }
        return true;
    }
</script>

<footer class="footer" style="display:flex;justify-content:center;align-items:center;flex-wrap: wrap;padding:1rem 5%;background:#0A4A3A;">
    <div class="footer-text">
        <p style="font-size: 1.2rem;color: #FFFFFF;">Copyright &copy; 2023 by GrowMentor | All Right Reserved</p>
    </div>
    <div class="Logo" style="display:flex;justify-content:end;align-items:center;flex-wrap: wrap;">
        <li>
            <a href="home.php"><img src="./images/navLogo.png" alt=""></a>
        </li>
    </div>
</footer>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') { // Form is Posted
    // Assign Variables
    $caption = $_POST['caption'];
    if(isset($_POST['public'])) {
        $public = "Y";
    } else {
        $public = "N";
    }
    $poster = $_SESSION['user_id'];
    // Apply Insertion Query
    $sql = "INSERT INTO posts (post_caption, post_public, post_time, post_by)
            VALUES ('$caption', '$public', NOW(), $poster)";
    $query = mysqli_query($conn, $sql);
    // Action on Successful Query
    if($query){
        // Upload Post Image If a file was chosen
        if (!empty($_FILES['fileUpload']['name'])) {
            echo 'FUUUQ';
            // Retrieve Post ID
            $last_id = mysqli_insert_id($conn);
            include 'functions/upload.php';
        }
        header("location: home.php");
    }
}
?>

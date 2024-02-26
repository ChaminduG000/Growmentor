<?php
//
require 'functions/functions.php';
session_start();
// Check whether user is logged on or not
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
// Establish Database Connection
$conn = connect();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<title>Growmentor | Knowledge Hub</title>
    <!-- <link rel="stylesheet" type="text/css" href="resources/css/main.css"> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
*{
    margin: 0;
    padding: 0;
    scroll-behavior: smooth;
    list-style-type: none;
    font-family: 'Poppins', sans-serif;
} 
        
body {
        background-image: url('images/search.jpg'); /* Replace 'background.jpg' with your image file name */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 100vh;
        backdrop-filter: blur(6px);
        font-family: 'Poppins', sans-serif;
        overflow-x: auto;
        margin: 0;
        padding: 0;
    }

    .userquery a.profilelink,.container .post div a.profilelink{
        text-decoration: none;
        font-family: 'Poppins',sans-serif;
        padding: 5px;
        color: #ff0000cc;
        font-weight: 600;  
    }
    .result{
        width: 90%;
        height: auto;
        margin: 0 auto;
        box-shadow: 0 .1rem 2.5rem rgba(50, 50, 50, 0.582);
        border-radius: 20px;
    }
    .result img{
        margin: 0 auto;
    }
    .result h1{
        margin: 0 auto;
        color: #006759;
        font-size: small;
        font-weight: bold;
    }

    .footer{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: .5rem 5%;
            background: #0A4A3A;
        }
        .footer-text p{
            font-size: 1.2rem;
            color: #FFFFFF;
        }
</style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="result d-flex align-items:center; justify-content-center mb-3" style="background-color:#01391745;">
    <img src="./images/navLogo.png" alt="" class="d-flex justify-content-start">
    <h1 class="text-center p-4 d-flex" >RESULTS</h1>
    </div>

    <div class="container w-75">
   
        <?php
            $location = $_GET['location'];
            $key = $_GET['query'];
            if($location == 'emails') {
                $sql = "SELECT * FROM users WHERE users.user_email = '$key'";
                include 'includes/userquery.php';
            } else if($location == 'names') {
                $name = explode(' ', $key, 2); // Break String into Array.
                if(empty($name[1])) {
                    $sql = "SELECT * FROM users WHERE users.user_firstname = '$name[0]' OR users.user_lastname= '$name[0]'";
                } else {
                    $sql = "SELECT * FROM users WHERE users.user_firstname = '$name[0]' AND users.user_lastname= '$name[1]'";
                }
                include 'includes/userquery.php';
            } else if($location == 'hometowns') {
                $sql = "SELECT * FROM users WHERE users.user_hometown = '$key'";
                include 'includes/userquery.php';
            } else if($location == 'posts') {
                $sql = "SELECT posts.post_caption, posts.post_time, posts.post_public, users.user_firstname,
                                users.user_lastname, users.user_id, users.user_gender, posts.post_id
                        FROM posts
                        JOIN users
                        ON posts.post_by = users.user_id
                        WHERE (posts.post_public = 'Y' OR users.user_id = {$_SESSION['user_id']}) AND posts.post_caption LIKE '%$key%'
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
                        WHERE posts.post_public = 'N' AND posts.post_caption LIKE '%$key%'
                        ORDER BY post_time DESC";
                $query = mysqli_query($conn, $sql);
                $width = '40px'; // Profile Image Dimensions
                $height = '40px';
                if(!$query){
                    echo mysqli_error($conn);
                }
                if(mysqli_num_rows($query) == 0){
                    echo '<div class="post">';
                    echo 'There is no results given the keyword, try to widen your search query.';
                    echo '</div>';
                    echo '<br>';
                }
                while($row = mysqli_fetch_assoc($query)){
                    include 'includes/post.php';
                    echo '<br>';
                }
            }    
        ?>
    </div>

    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2023 by GrowMentor | All Right Reserved</p>
        </div>
    </footer>
</body>
</html>

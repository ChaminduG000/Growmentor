<?php 
require 'functions/functions.php';
session_start();
ob_start();
// Check whether user is logged on or not
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
// Establish Database Connection
$conn = connect();
?>

<?php
if(isset($_GET['id']) && $_GET['id'] != $_SESSION['user_id']) {
    $current_id = $_GET['id'];
    $flag = 1;
} else {
    $current_id = $_SESSION['user_id'];
    $flag = 0;
}
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
    body {
        background-image: url('images/12.jpg'); /* Replace 'background.jpg' with your image file name */
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }
    html{
    overflow-x: hidden;
}
    h1{
        color: #352205d1;
    }
    .container{
        margin: auto;
        width: 100%;
        height: 100vh;
    }
    .container div.post img,#cap, .profilelink{
        margin: 0 2rem 0 2rem;
    }
    .container div.post img,
    .container div.post a.profilelink{
        border-radius: 50%;
        color: #004024;
        font-weight: bold;
    }
    .post{
        display: flex;
        justify-content: center;
        width: 60%;
        margin:auto;
    }

    p.public{
        padding: 2%;
    }
    div .post{
        display: block;
        width: auto;
        height: auto;
        margin: 10px;
        padding: auto;
        background-color: #c6ebcca8;
    }
    div .profile{
        background-color: #05351fc7;
        border-radius: 15px;
        box-shadow: 0.1rem 0.3rem 0.2rem rgb(0 0 0 / 84%);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 1%;
        padding: 2%;
        width: fit-content;
        font-family: Poppins,sans-serif;
    }
    a:not([href]):not([class]), a:not([href]):not([class]):hover {
        color: inherit;
        text-decoration: none;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
    }

    input[type="file"]{
        display: none;
    }
    label.upload{
        cursor: pointer;
        background-color: #0e4719;
        padding: 8px 12px;
        display: inline-block;
        width: auto;
        border-radius: 10px;
        box-shadow: 0.1rem 0.3rem 0.2rem rgb(0 0 0 / 84%);
        transition: .5s ease;
    }
    label.upload:hover{
       background-color: #062d0e;
    }
    .container input[type=submit] {
        background-color: #096332a8;
        border-radius: 10px;
        box-shadow: 0.1rem 0.3rem 0.2rem rgb(0 0 0 / 84%);
        padding: 5px;
        color: antiquewhite;
        transition: .5s ease;
    }
    .container input[type=submit]:hover{
        color: #2db1b9;
        background-color: #0e4719;
    }
    .changeprofile{
        color: #ffffff;
        font-family: Fontin SmallCaps;
        padding-right: 4rem;
    }
    input{
        border-radius: 10px;
        background-color: #ffffff78;
    }
    @media(max-width:768px){
        div .post{
            display: block;
            width: auto;
            height: auto;
            margin: 6px;
            padding: auto;
            font-size: 15px;
        }
    }
    @media(max-width:550px){
        div .post{
            display: block;
            width: auto;
            height: auto;
            margin: 8px;
            padding: auto;
            font-size: 10px;
        }
    }
    @media(max-width:550px){
        div .post{
            display: block;
            width: auto;
            height: auto;
            margin: 6px;
            padding: auto;
            font-size: 8px;
        }
    }
    
    </style>
</head>

<body>
<?php include 'includes/navbar.php'; ?>
    <div class="container">
        <h1 class="text-center mt-4 fw-bold">User Profile</h1>
        <?php
        $postsql;
        if($flag == 0) { // Your Own Profile       
            $postsql = "SELECT posts.post_caption, posts.post_time, users.user_firstname, users.user_lastname,
                                posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                users.user_birthdate, users.user_hometown, users.user_status, users.user_about, 
                                posts.post_id
                        FROM posts
                        JOIN users
                        ON users.user_id = posts.post_by
                        WHERE posts.post_by = $current_id
                        ORDER BY posts.post_time DESC";
            $profilesql = "SELECT users.user_id, users.user_gender, users.user_hometown, users.user_status, users.user_birthdate,
                                 users.user_firstname, users.user_lastname
                          FROM users
                          WHERE users.user_id = $current_id";
            $profilequery = mysqli_query($conn, $profilesql);
        } else { // Another Profile ---> Retrieve User data and friendship status
            $profilesql = "SELECT users.user_id, users.user_gender, users.user_hometown, users.user_status, users.user_birthdate,
                                    users.user_firstname, users.user_lastname, userfriends.friendship_status
                            FROM users
                            LEFT JOIN (
                                SELECT friendship.user1_id AS user_id, friendship.friendship_status
                                FROM friendship
                                WHERE friendship.user1_id = $current_id AND friendship.user2_id = {$_SESSION['user_id']}
                                UNION
                                SELECT friendship.user2_id AS user_id, friendship.friendship_status
                                FROM friendship
                                WHERE friendship.user1_id = {$_SESSION['user_id']} AND friendship.user2_id = $current_id
                            ) userfriends
                            ON userfriends.user_id = users.user_id
                            WHERE users.user_id = $current_id";
            $profilequery = mysqli_query($conn, $profilesql);
            $row = mysqli_fetch_assoc($profilequery);
            mysqli_data_seek($profilequery,0);
            if(isset($row['friendship_status'])){ // Either a friend or requested as a friend
                if($row['friendship_status'] == 1){ // Friend
                    $postsql = "SELECT posts.post_caption, posts.post_time, users.user_firstname, users.user_lastname,
                                        posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                        users.user_birthdate, users.user_hometown, users.user_status, users.user_about, 
                                        posts.post_id
                                FROM posts
                                JOIN users
                                ON users.user_id = posts.post_by
                                WHERE posts.post_by = $current_id
                                ORDER BY posts.post_time DESC";
                }
                else if($row['friendship_status'] == 0){ // Requested as a Friend
                    $postsql = "SELECT posts.post_caption, posts.post_time, users.user_firstname, users.user_lastname,
                                        posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                        users.user_birthdate, users.user_hometown, users.user_status, users.user_about, 
                                        posts.post_id
                                FROM posts
                                JOIN users
                                ON users.user_id = posts.post_by
                                WHERE posts.post_by = $current_id AND posts.post_public = 'Y'
                                ORDER BY posts.post_time DESC";
                }
            } else { // Not a friend
                $postsql = "SELECT posts.post_caption, posts.post_time, users.user_firstname, users.user_lastname,
                                    posts.post_public, users.user_id, users.user_gender, users.user_nickname,
                                    users.user_birthdate, users.user_hometown, users.user_status, users.user_about, 
                                    posts.post_id
                            FROM posts
                            JOIN users
                            ON users.user_id = posts.post_by
                            WHERE posts.post_by = $current_id AND posts.post_public = 'Y'
                            ORDER BY posts.post_time DESC";
            }
        }
        $postquery = mysqli_query($conn, $postsql);    
        if($postquery){
            // Posts
            $width = '40px'; 
            $height = '40px';
            if(mysqli_num_rows($postquery) == 0){ // No Posts
                if($flag == 0){ // Message shown if it's your own profile
                    echo '<div class="post">';
                    echo 'You don\'t have any posts yet';
                    echo '</div>';
                } else { // Message shown if it's another profile other than you.
                    echo '<div class="post">';
                    echo 'There is no public posts to show.';
                    echo '</div>';
                }
                include 'includes/profile.php';
            } else {
                while($row = mysqli_fetch_assoc($postquery)){
                    include 'includes/post.php';
                }
                // Profile Info
                include 'includes/profile.php';
                ?>
                <br>
                <?php if($flag == 0){?>
                <div class="profile">
                    <center class="changeprofile">Change Profile Picture</center>
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <center>
                            <label class="upload" onchange="showPath()">
                                <span id="path" style="color: #2db1b9;">Browse</span>
                                <input type="file" name="fileUpload" id="selectedFile">
                            </label>
                        </center>
                        <br>
                        <input type="submit" value="Upload Image" name="profile">
                    </form>
                </div>
                <br>
                <div class="profile" id="prfl">
                    <center class="changeprofile">Add Phone Number</center>
                    <br>
                    <form method="post" onsubmit="return validateNumber()">
                        <center>
                            <input type="text" name="number" id="phonenum">
                            <div class="required"></div>
                            <br>
                            <input type="submit" value="Submit" name="phone">
                        </center>
                    </form>
                </div>
                <br>
                <?php } ?>
                <?php
            }
        }
        ?>
        <footer class="footer" style="display:flex;justify-content:center;align-items:center;flex-wrap: wrap;padding:1rem 5%;background:#0A4A3A;">
            <div class="footer-text">
                <p style="font-size: 1.2rem;color: #FFFFFF;">Copyright &copy; 2023 by GrowMentor | All Right Reserved</p>
            </div>
            <div class="Logo" style="display:flex;justify-content:end;align-items:center;flex-wrap: wrap;padding:0rem 5%;">
                <li>
                    <a href="home.php"><img src="./images/navLogo.png" alt=""></a>
                </li>
            </div>
        </footer>
    </div>
    

</body>
<script>
function showPath(){
    var path = document.getElementById("selectedFile").value;
    path = path.replace(/^.*\\/, "");
    document.getElementById("path").innerHTML = path;
}
function validateNumber(){
    var number = document.getElementById("phonenum").value;
    var required = document.getElementsByClassName("required");
    if(number == ""){
        required[0].innerHTML = "You must type Your Number.";
        return false;
    } else if(isNaN(number)){
        required[0].innerHTML = "Phone Number must contain digits only."
        return false;
    }
    return true;
}
</script>
</html>
<?php include 'functions/upload.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
    if (isset($_POST['request'])) { // Send a Friend Request
        $sql3 = "INSERT INTO friendship(user1_id, user2_id, friendship_status)
                 VALUES ({$_SESSION['user_id']}, $current_id, 0)";
        $query3 = mysqli_query($conn, $sql3);
        if(!$query3){
            echo mysqli_error($conn);
        }
    } else if(isset($_POST['remove'])) { // Remove
        $sql3 = "DELETE FROM friendship
                 WHERE ((friendship.user1_id = $current_id AND friendship.user2_id = {$_SESSION['user_id']})
                 OR (friendship.user1_id = {$_SESSION['user_id']} AND friendship.user2_id = $current_id))
                 AND friendship.friendship_status = 1";
        $query3 = mysqli_query($conn, $sql3);
        if(!$query3){
            echo mysqli_error($conn);
        }
    } else if(isset($_POST['phone'])) { // Add a Phone Number to Your Profile
        $sql3 = "INSERT INTO user_phone(user_id, user_phone) VALUES ({$_SESSION['user_id']},{$_POST['number']})";
        $query3 = mysqli_query($conn, $sql3);
        if(!$query3){
            echo mysqli_error($conn);
        } 
    }
    sleep(4);
}
?>

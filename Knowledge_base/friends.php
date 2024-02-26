<?php 
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
        font-family: 'Arial', sans-serif;
    } 
    html{
        overflow-x: hidden;
    }
        .frame a{
        text-decoration: none;
        color: #3cffb0f0;
    }
    .frame a:hover{
        text-decoration: none;
    }
    body {
        width: 100%;
        height: 169vh;
        background-color: #107b4d; 
        background-image: linear-gradient(to right, #094341 , #00ff7e); 
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }
    .container{
        padding: 5px;
        display: flex;
        flex-wrap: wrap;
    }
    .center{
        display: flex;
        flex-wrap: wrap;
    }
        
    </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<h1 class="text-center mt-2" style="color:#002a08; font-weight:500; font-family:Poppins,sans-serif;">Friends</h1>  
<div class="container mt-4 p-4">
        <?php
            echo '<center>'; 
            $sql = "SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_gender
                    FROM users
                    JOIN (
                        SELECT friendship.user1_id AS user_id
                        FROM friendship
                        WHERE friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 1
                        UNION
                        SELECT friendship.user2_id AS user_id
                        FROM friendship
                        WHERE friendship.user1_id = {$_SESSION['user_id']} AND friendship.friendship_status = 1
                    ) userfriends
                    ON userfriends.user_id = users.user_id";
            $query = mysqli_query($conn, $sql);
            $width = '168px';
            $height = '168px';
            if($query){
                if(mysqli_num_rows($query) == 0){
                    echo '<div class="post">';
                    echo 'You don\'t yet have any friends.';
                    echo '</div>';
                } else {
                    while($row = mysqli_fetch_assoc($query)){
                    echo '<div class="frame">';
                    echo '<center>';
                    include 'includes/profile_picture.php';
                    echo '<br>';
                    echo '<a href="profile.php?id=' . $row['user_id'] . '">' . $row['user_firstname'] . ' ' . $row['user_lastname'] . '</a>';
                    echo '</center>';
                    echo '</div>';
                    }
                }
            }
            echo '</center>';
        ?>
    </div>
    
    
</body>
</html>
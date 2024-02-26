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
    font-family: 'Poppins', sans-serif;
} 
html{
    overflow-x: hidden;
}
body {
    min-height: 100vh;
    background-image: url('images/fbg.jpg'); /* Replace 'background.jpg' with your image file name */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    backdrop-filter: blur(2px);
    font-family: Arial, sans-serif;
    margin: 0px;
    padding: 0px;
}
.container{
    background-color: #00ffb873;
    height: 100vh;
    box-shadow: 0 .1rem 2.5rem rgba(50, 50, 50, 0.582);
}
.container img{
    width: 10rem;
    height: auto;
}
</style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
    <div class="container p-4 mt-4">
        <img src="./Images/logo2.png" alt="">
        <h1 class="text-center">Friend Requests</h1>
        <?php
        // Responding to Request
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['accept'])) {
                $sql = "UPDATE friendship
                        SET friendship.friendship_status = 1
                        WHERE friendship.user1_id = {$_GET['id']} AND friendship.user2_id = {$_SESSION['user_id']}";
                $query = mysqli_query($conn, $sql);
                if($query){
                    echo '<div class="userquery">';
                    echo 'You have accepted ' . $_GET['name'];
                    echo '<br><br>';
                    echo 'Redirecting in 5 seconds';
                    echo '<br><br>';
                    echo '</div>';
                    echo '<br>';
                    header("refresh:5; url=requests.php" );
                }
                else{
                    echo mysqli_error($conn);
                }
            } else if(isset($_GET['ignore'])) {
                $sql6 = "DELETE FROM friendship
                        WHERE friendship.user1_id = {$_GET['id']} AND friendship.user2_id = {$_SESSION['user_id']}";
                $query6 = mysqli_query($conn, $sql6);
                if($query){
                    echo '<div class="userquery">';
                    echo 'You have Ignored ' . $_GET['name'];
                    echo '<br><br>';
                    echo 'Redirecting in 5 seconds';
                    echo '<br><br>';
                    echo '</div>';
                    echo '<br>';
                    header("refresh:5; url=requests.php" );
                }
            }
        }
        //
        ?>
        <?php
        $sql = "SELECT users.user_gender, users.user_id, users.user_firstname, users.user_lastname
                FROM users
                JOIN friendship
                ON friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 0 AND friendship.user1_id = users.user_id";
        $query = mysqli_query($conn, $sql);
        $width = '168px';
        $height = '168px';
        if(!$query)
            echo mysqli_error($conn);
        if($query){
            if(mysqli_num_rows($query) == 0){
                echo '<div class="userquery">';
                echo 'You have no pending friend requests.';
                echo '<br><br>';
                echo '</div>';
            }
            while($row = mysqli_fetch_assoc($query)){
                echo '<div class="userquery">';
                include 'includes/profile_picture.php';
                echo '<br>';
                echo '<a class="profilelink" href="profile.php?id=' . $row['user_id'] .'">' . $row['user_firstname'] . ' ' . $row['user_lastname'] . '<a>';
                echo '<form method="get" action="requests.php">';
                echo '<input type="hidden" name="id" value="' . $row['user_id'] . '">';
                echo '<input type="hidden" name="name" value="' . $row['user_firstname'] . '">';
                echo '<input type="submit" value="Accept" name="accept">';
                echo '<br><br>';
                echo '<input type="submit" value="Ignore" name="ignore">';
                echo '<br><br>';
                echo'</form>';
                echo '</div>';
                echo '<br>';
            }
        }
        ?>
    </div>
    <footer class="footer" style="display:flex;justify-content:center;align-items:center;flex-wrap: wrap;padding:1rem 5%;background:#0A4A3A;">
        <div class="footer-text">
            <p style="font-size: 1.2rem;color: #FFFFFF;">Copyright &copy; 2023 by GrowMentor | All Right Reserved</p>
        </div>
        <div class="Logo" style="display:flex;justify-content:end;align-items:center;flex-wrap: wrap; padding-left:5rem">
            <li>
                <a href="home.php"><img src="./images/navLogo.png" alt=""></a>
            </li>
        </div>
    </footer>
</body>
</html>
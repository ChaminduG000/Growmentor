<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container"  style="background-color:#072515; background-image: url(images/profile.JPG);background-repeat: no-repeat;
    background-size: cover;
    background-position: center;">
   
   <div class="profile" style="background-color:#00000030;" >
   <h3>GrowMentor User Profile</h3>
   
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      
      <h3 style="text-transform: uppercase;"><?php echo $fetch['first_name']; ?></h3>
      <a href="update_profile.php" class="btn">Update</a>
      <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
     
   </div>
</div>
</body>
</html>
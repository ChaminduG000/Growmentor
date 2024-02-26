<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$fetch = []; // Initialize $fetch to an empty array

if (isset($_POST['update_profile'])) {

    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

    mysqli_query($conn, "UPDATE `users` SET first_name = '$update_name', phone_number = '$update_phoneNumber' WHERE user_id = '$user_id'") or die('query failed');

    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if (!empty($new_pass) || !empty($confirm_pass)) {
      if (isset($fetch['password']) && password_verify($old_pass, $fetch['password'])) {
          if ($new_pass != $confirm_pass) {
              $message[] = 'Confirm password not matched!';
          } else {
              $hashed_new_pass = password_hash($new_pass, PASSWORD_BCRYPT);
              mysqli_query($conn, "UPDATE `users` SET password = '$hashed_new_pass' WHERE user_id = '$user_id'") or die('query failed');
              $message[] = 'Password updated successfully!';
          }
      } else {
          $message[] = 'Old password not matched!';
      }
  }
  

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'uploaded_img/' . $update_image;

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image is too large';
        } else {
            $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE user_id = '$user_id'") or die('query failed');
            if ($image_update_query) {
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
            }
            $message[] = 'Image updated successfully!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="update-profile" style="background-image: url(images/profile2.JPG);
                                    background-repeat: no-repeat;
                                    background-size: cover;
                                    background-position: center;">

    <?php
    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($select) > 0) {
        $fetch = mysqli_fetch_assoc($select);
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data" style="background-color: #ffffff4d;">
        <?php
        if ($fetch['image'] == '') {
            echo '<img src="images/default-avatar.png">';
        } else {
            echo '<img src="uploaded_img/' . $fetch['image'] . '">';
        }
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . $msg . '</div>';
            }
        }
        ?>
        <div class="flex">
            <div class="inputBox">
                <span style="color:#000000;font-weight:bold;">Username :</span>
                <input type="text" name="update_name" value="<?php echo $fetch['first_name']; ?>" class="box">
                <span style="color:#000000;font-weight:bold;">Your Phone Number :</span>
                <input type="text" name="phoneNumber" value="<?php echo $fetch['phone_number']; ?>" class="box">
                <span style="color:#000000;font-weight:bold;">Update Your Photo :</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
                <span style="color:#000000;font-weight:bold;">Previous Password :</span>
                <input type="password" name="old_pass" placeholder="Enter previous password" class="box">
                <span style="color:#000000;font-weight:bold;">New Password :</span>
                <input type="password" name="new_pass" placeholder="Enter new password" class="box">
                <span style="color:#000000;font-weight:bold;">Confirm Password :</span>
                <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">
            </div>
        </div>
        <input type="submit" value="Update Profile" name="update_profile" class="btn">
        <a href="home.php" class="delete-btn">Back</a>
    </form>

</div>

</body>
</html>

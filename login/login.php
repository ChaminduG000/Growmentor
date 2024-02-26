<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($conn, "SELECT user_id, password FROM users WHERE phone_number = ?");
    mysqli_stmt_bind_param($stmt, "s", $phoneNumber);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $hashedPassword);
    mysqli_stmt_fetch($stmt);

    // Verify the password using password_verify
    if (password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $user_id;
        header('location:home.php');
    } else {
        $message[] = 'Incorrect phone number or password!';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <div class="col-md-6 col-lg-5 d-none d-md-block" style="border-radius: 1rem 0 0 1rem; background-color: #0A2000; box-shadow: 20px 20px 10px rgba(39, 39, 39, 0.658);">
            <img src="./Images/login.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; transform: scaleX(-1);" />
            <img src="./Images/logo2.png" alt="login form" class="img-fluid logo" style="border-radius: 1rem 0 0 1rem;" />
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Login</h3>
            <?php
            if (isset($message)) {
                foreach ($message as $msg) {
                    echo '<div class="message">' . $msg . '</div>';
                }
            }
            ?>
            <label class="d-flex flex-start mt-4">Your Phone Number</label>
            <input type="text" name="phoneNumber" placeholder="Enter phone number" class="box" required>
            <label class="d-flex flex-start">Enter Your Password</label>
            <input type="password" name="password" placeholder="Enter password" class="box" required>
            <input type="submit" name="submit" value="Login now" class="btn">
            <p>Don't have an account? <a href="register.php" class="fw-bold">Register now</a></p>
            <div class="about"><p>2023&copy; All Rights reserved | GrowMentor</p></div>
        </form>
    </div>
</body>
</html>

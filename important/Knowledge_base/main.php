<?php 
require 'functions/functions.php';
session_start();
if (isset($_SESSION['user_id'])) {
    header("location:home.php");
}
session_destroy();
session_start();
ob_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Growmentor | knowledge Hub</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <style>
        .container{
            margin: 40px auto;
            width: 400px;
        }
        .content {
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 5px #4267b2;
        }
        
        
        body {
            background-image: url('images/123.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            backdrop-filter: blur(4px);
        
        }
        h1 {
            color: #014b00; 
            text-align: center;
            background-color: #8d8b8b5e;
            backdrop-filter: blur(6px);
            box-shadow: 0.1rem 0.3rem 0.2rem rgb(89 89 89 / 57%);
            padding: 20px;
            margin: 0 10%;
            border-radius: 6px;
        }
        @media screen and (max-width: 820px) {
            h1{
                width: 100%;
                margin: 0 0;
                padding: 10px;
            }

            .footer-text p{
                font-size: .8rem;
            }
        }
        @media screen and (max-width: 660px) {
            h1{
                font-size: 1.5rem;
            }
            .footer{
                padding: .5rem 2%;
            }
        }

        .container {
            margin: 40px auto;
            width: 400px;
        }
        .content {
            padding: 30px;
            background-color: #ffffff; 
            box-shadow: 0 0 5px #006400;  
        }
        .tablink {
            background-color: #006400; 
            color: #ffffff; 
        }
        .tablink:hover {
            background-color: #004f00; 
        }

        .tabcontent {
            display: none;
        }
        .active {
            display: block;
        }
        div.tab button:hover {
            background-color: #033d1d;
            transition: .5s ease;         
        }

        label {
            color: #006400; 
        }
        input[type="text"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #006400;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #006400;
            color: #ffffff; 
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #004f00; 
        }

        @media(max-width:760px){
            .container {
                margin:40px auto;
                width: 300px;
            }
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
        @media screen and (max-width: 820px) {
    h1 {
        width: 100%;
        margin: 0;
        padding: 10px;
    }

    .footer-text p {
        font-size: 0.8rem;
    }

    .container {
        width: 100%;
    }

    /* Add more responsive styles as needed */
}

@media screen and (max-width: 660px) {
    h1 {
        font-size: 1.5rem;
        margin: 0;
    }

    .footer {
        padding: 0.5rem 2%;
    }

    /* Add more responsive styles as needed */
}
.footer {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0.5rem 5%;
    background: #0A4A3A;
}

.Logo {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    padding-left: 5%;
    margin-top: 1rem; /* Add margin for separation from the text */
}
@media (max-width: 760px) {
    .container {
        margin: 40px auto;
        width: 100%;
    }
}

    </style>
   
</head>
<body>
    <h1>Welcome to Growmentor | knowledge Hub </h1><br><br>
    <div class="container">
        <div class="tab">
            <button class="tablink active" onclick="openTab(event,'signin')" id="link1">Login</button>
            <button class="tablink" onclick="openTab(event,'signup')" id="link2">Sign Up</button>
        </div>
        <div class="content">
            <div class="tabcontent" id="signin">
                <form method="post" onsubmit="return validateLogin()">
                    <label>Email<span>*</span></label><br>
                    <input type="text" name="useremail" id="loginuseremail">
                    <div class="required"></div>
                    <br>
                    <label>Password<span>*</span></label><br>
                    <input type="password" name="userpass" id="loginuserpass">
                    <div class="required"></div>
                    <br><br>
                    <input type="submit" value="Login" name="login">
                </form>
            </div>
            <div class="tabcontent" id="signup">
                <form method="post" onsubmit="return validateRegister()">
                    <!--Package One-->
                    <h2>Highly Required Information</h2>
                    <hr>
                    <!--First Name-->
                    <label>First Name<span>*</span></label><br>
                    <input type="text" name="userfirstname" id="userfirstname">
                    <div class="required"></div>
                    <br>
                    <!--Last Name-->
                    <label>Last Name<span>*</span></label><br>
                    <input type="text" name="userlastname" id="userlastname">
                    <div class="required"></div>
                    <br>
                    <!--Nickname-->
                    <label>Nickname</label><br>
                    <input type="text" name="usernickname" id="usernickname">
                    <div class="required"></div>
                    <br>
                    <!--Password-->
                    <label>Password<span>*</span></label><br>
                    <input type="password" name="userpass" id="userpass">
                    <div class="required"></div>
                    <br>
                    <!--Confirm Password-->
                    <label>Confirm Password<span>*</span></label><br>
                    <input type="password" name="userpassconfirm" id="userpassconfirm">
                    <div class="required"></div>
                    <br>
                    <!--Email-->
                    <label>Email<span>*</span></label><br>
                    <input type="text" name="useremail" id="useremail">
                    <div class="required"></div>
                    <br>
                    <!--Birth Date-->
                    Birth Date<span>*</span><br>
                    <select name="selectday">
                    <?php
                    for($i=1; $i<=31; $i++){
                        echo '<option value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                    </select>
                    <select name="selectmonth">
                    <?php
                    echo '<option value="1">January</option>';
                    echo '<option value="2">February</option>';
                    echo '<option value="3">March</option>';
                    echo '<option value="4">April</option>';
                    echo '<option value="5">May</option>';
                    echo '<option value="6">June</option>';
                    echo '<option value="7">July</option>';
                    echo '<option value="8">August</option>';
                    echo '<option value="9">September</option>';
                    echo '<option value="10">October</option>';
                    echo '<option value="11">Novemeber</option>';
                    echo '<option value="12">December</option>';
                    ?>
                    </select>
                    <select name="selectyear">
                    <?php
                    for($i=2017; $i>=1900; $i--){
                        if($i == 1996){
                            echo '<option value="'. $i .'" selected>'. $i .'</option>';
                        }
                        echo '<option value="'. $i .'">'. $i .'</option>';
                    }
                    ?>
                    </select>
                    <br><br>
                    <!--Gender-->
                    <input type="radio" name="usergender" value="M" id="malegender" class="usergender">
                    <label>Male</label>
                    <input type="radio" name="usergender" value="F" id="femalegender" class="usergender">
                    <label>Female</label>
                    <div class="required"></div>
                    <br>
                    <!--Hometown-->
                    <label>Hometown</label><br>
                    <input type="text" name="userhometown" id="userhometown">
                    <br>
                    <!--Package Two-->
                    <h2>Additional Information</h2>
                    <hr>
                    <!--Marital Status-->
                    <input type="radio" name="userstatus" value="S" id="singlestatus">
                    <label>Single</label>
                    <input type="radio" name="userstatus" value="E" id="engagedstatus">
                    <label>Engaged</label>
                    <input type="radio" name="userstatus" value="M" id="marriedstatus">
                    <label>Married</label>
                    <br><br>
                    <!--About Me-->
                    <label>About Me</label><br>
                    <textarea rows="12" name="userabout" id="userabout"></textarea>
                    <br><br>
                    <input type="submit" value="Create Account" name="register">
                </form>
            </div>
        </div>
    </div>
    <footer class="footer" style="display:flex;justify-content:center;align-items:center;flex-wrap:wrap;padding:1rem 5%;background:#0A4A3A;">
        <div class="footer-text">
            <p style="font-size: 1.2rem;color: #FFFFFF;">Copyright &copy; 2023 by GrowMentor | All Right Reserved</p>
        </div>
        <div class="Logo" style="display:flex;align-items:center;flex-wrap: wrap;padding-left:5%;">
            <li>
                <a href="home.php"><img src="./images/navLogo.png" alt=""></a>
            </li>
        </div>
    </footer>

    <script src="resources/js/main.js"></script>
</body>
</html>

<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
    if (isset($_POST['login'])) { // Login process
        $useremail = $_POST['useremail'];
        $userpass = md5($_POST['userpass']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$useremail' AND user_password = '$userpass'");
        if($query){
            if(mysqli_num_rows($query) == 1) {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
                header("location:home.php");
            }
            else {
                ?> <script>
                    document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                    document.getElementsByClassName("required")[1].innerHTML = "Invalid Login Credentials.";
                </script> <?php
            }
        } else{
            echo mysqli_error($conn);
        }
    }
    if (isset($_POST['register'])) { // Register process
        // Retrieve Data
        $userfirstname = $_POST['userfirstname'];
        $userlastname = $_POST['userlastname'];
        $usernickname = $_POST['usernickname'];
        $userpassword = md5($_POST['userpass']);
        $useremail = $_POST['useremail'];
        $userbirthdate = $_POST['selectyear'] . '-' . $_POST['selectmonth'] . '-' . $_POST['selectday'];
        $usergender = $_POST['usergender'];
        $userhometown = $_POST['userhometown'];
        $userabout = $_POST['userabout'];
        if (isset($_POST['userstatus'])){
            $userstatus = $_POST['userstatus'];
        }
        else{
            $userstatus = NULL;
        }
        // Check for Some Unique Constraints
        $query = mysqli_query($conn, "SELECT user_nickname, user_email FROM users WHERE user_nickname = '$usernickname' OR user_email = '$useremail'");
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            if($usernickname == $row['user_nickname'] && !empty($usernickname)){
                ?> <script>
                document.getElementsByClassName("required")[4].innerHTML = "This Nickname already exists.";
                </script> <?php
            }
            if($useremail == $row['user_email']){
                ?> <script>
                document.getElementsByClassName("required")[7].innerHTML = "This Email already exists.";
                </script> <?php
            }
        }
        // Insert Data
        $sql = "INSERT INTO users(user_firstname, user_lastname, user_nickname, user_password, user_email, user_gender, user_birthdate, user_status, user_about, user_hometown)
                VALUES ('$userfirstname', '$userlastname', '$usernickname', '$userpassword', '$useremail', '$usergender', '$userbirthdate', '$userstatus', '$userabout', '$userhometown')";
        $query = mysqli_query($conn, $sql);
        if($query){
            $query = mysqli_query($conn, "SELECT user_id FROM users WHERE user_email = '$useremail'");
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['user_id'];
            header("location:home.php");
        }
    }
}
?>
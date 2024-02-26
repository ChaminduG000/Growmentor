
<?php
session_start(); // Start a PHP session

if (isset($_SESSION["registration_success"]) && $_SESSION["registration_success"]) {
    // Display the success message
    echo "Registration successful. You can now log in.";
    // Reset the session variable
    $_SESSION["registration_success"] = false;
}
?>
<?php
require 'config.php';

if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $phone_number = $_POST["phone_number"]; 
  $message = $_POST["message"];
  }

  $query = "INSERT INTO form_submission VALUES('$name', '$phone_number', '$message')";
  mysqli_query($conn,$query);
  echo
  "
  <script> alert('Data Inserted Successfully'); </script>
  ";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>Grow Mentor</title>
    
    <link rel="icon" type="image/x-icon" href="./Images/favicon.ico">
    <link rel="stylesheet" href="static/css/style.css">
   <style>
    /* Add this CSS to your existing stylesheet or in a separate CSS file */

/* Plant card styles */
.plant-card {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    transition: transform 0.2s ease-in-out;
    margin-bottom: 20px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
}

.plant-card img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 10px;
}

.plant-card h4 {
    font-size: 18px;
    color: #333;
}

/* Hover effect */
.plant-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
}

    
        .plant-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: transform 0.2s ease-in-out;
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .plant-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .plant-card h4 {
            font-size: 18px;
            color: #333;
        }

        /* Hover effect */
        .plant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
        }

        /* Set the background color for the Disease Check Section */
        .diseaseCheckSection {
            background-color: #c9e5cabb; /* Use the background color from the Contact Section */
        }
        .plant-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px; /* Reduce padding to make the card smaller */
            text-align: center;
            transition: transform 0.2s ease-in-out;
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .plant-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .plant-card h4 {
            font-size: 16px; /* Reduce font size for smaller cards */
            color: #333;
        }

        /* Hover effect */
        .plant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</style>
</head>
<body>
        <!-- Header -->
        <div class="mainWrapper sticky navbar" id="main">
            <div class="centerWrapper" id="center">
                <div class="leftWrapper" id="left">
                    <div class="navLogo" id="logoNav">
                        <a href="#home">
                            <img src="static/css/images/navLogo.png" alt="">
                        </a>
                    </div>
                    <div class="menuWrapper" id="menuW">
                        <ul>
                            <li><a class="active" href="#home">Home</a></li>
                            <li><a href="plantdisease">Service</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="http://localhost/growmentor/webapp/Knowledge_base/" target="_blank">Knowledge Hub</a></li>

                        </ul>
                    </div>
                </div>
                <div class="rightWrapper" id="right">
                    <div class="loginAndSignUp" id="lasp">
                        <ul>
                            <li><a href="login">Login</a></li>
                            <li><a href="signUp" target="_blank">Sign Up</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="mobile p-2" style="background-color: #020f04a0;">
                <a href="#home"><li><i class='bx bx-home container' ></i></i></li></a>   
                <a href="#contact"><li><i class='bx bx-mail-send'></i></i></li></a>   
                <span onclick= openNav()><li><i class='bx bx-menu container'></i></i></li></span>   
            </ul>
            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class='bx bx-x'></i></a>
                <div class="overlay-content" onclick="closeNav()">
                  <a  href="#about">About</a>
                  <a  href="plantdisease">Service</a>
                  <a  href="#contact">Contact</a>
                  <a  href="login">Login</a>
                  <a  href="signUp">Sign Up</a>
                  <a href="http://localhost/growmentor/webapp/Knowledge_base/" target="_blank">Knowledge Hub</a>

                </div>
              </div>
        </div>       
        <!-- Home Section -->
        <section class="homeSection" id="home" style="margin-bottom: -0px;"> <!-- Adjust the margin-bottom value -->
            <div class="homeTxtWrapper">
                <div class="welcomePara">
                    <p><span class="welcomeTxt">Welcome</span> to the Future of Plant Care. <br> 
                    To protect your plants Elevate with</p>
                </div>
                <div class="logoHome" id="logoHome">
                    
                </div>
                <div class="sayGoodbye" id="sayGoodbye">
                    <div class="boxView" id="boxView">
                        <p>Say goodbye to plant diseases</p>
                    </div>
                </div>
                <div class="testBtn" id="testBtn ">
                    <a href="plantdisease" class="btn btn-success">Check Your Plant</a>
                </div>
            </div> 
        </section>
    <!-- Disease Check Section -->
    <section class="diseaseCheckSection" id="disease-check" style="padding: 2px 0;"> <!-- Adjust the padding value -->
    <div class="container">
        <h2 class="text-center mt-5" style="color: #07270E; font-weight: bold;">~ You can check the diseases related to these plants ~</h2>
        <div class="row mt-2">
            <!-- Plant 1 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/ga.jpeg" alt="Plant 1">
                        <h4>Grape</h4>
                    </div>
                </a>
            </div>

            <!-- Plant 2 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/to.jpg" alt="Plant 2">
                        <h4>Tomato</h4>
                    </div>
                </a>
            </div>

            <!-- Plant 3 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/st.jpg" alt="Plant 3">
                        <h4>Strawberry</h4>
                    </div>
                </a>
            </div>

            <!-- Plant 4 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/cn.jpeg" alt="Plant 4">
                        <h4>Corn</h4>
                    </div>
                </a>
            </div>

            <!-- Plant 5 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/av.jpg" alt="Plant 5">
                        <h4>Aloe Vera</h4>
                    </div>
                </a>
            </div>
            
            <!-- Repeat the structure for more plant cards -->
            
            <!-- Plant 6 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/ap.jpg" alt="Plant 6">
                        <h4>Apple</h4>
                    </div>
                </a>
            </div>

            <!-- Plant 7 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/cr.jpg" alt="Plant 7">
                        <h4>Cherry</h4>
                    </div>
                </a>
            </div>

            <!-- Plant 8 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/bpp.png" alt="Plant 8">
                        <h4>Bell Pepper</h4>
                    </div>
                </a>
            </div>

            <!-- Plant 9 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/pt.jpg" alt="Plant 9">
                        <h4>Potato</h4>
                    </div>
                </a>
            </div>

            <!-- Plant 10 -->
            <div class="col-md-2 col-sm-2 col-12">
                <a href="plantdisease">
                    <div class="plant-card">
                        <img src="static/css/images/pe.jpg" alt="Plant 10">
                        <h4>Peach</h4>
                    </div>
                </a>
                
            </div>
            <div class="col-md-2 col-sm-2 col-12">
                
                    <div class="plant-card">
                        <img src="static/css/images/1111.png" alt="Plant 10">
                        <h4>Coming Soon..</h4>
                    </div>
                
                
            </div>
            <div class="col-md-2 col-sm-2 col-12">
                
                    <div class="plant-card">
                        <img src="static/css/images/1234.png" alt="Plant 10">
                        <h4>Coming Soon..</h4>
                    </div>
                
                
            </div>
        </a><!-- Close the anchor tag -->
    </div>
            </div>
        </div>
    </div>
</section>

    </section>
    <!-- About Section -->
   <section class="aboutSection" id="about" style="background-color: #445c44;">
    <h2 class="aboutTopic text-center mt-5" style="color: #95bdae;">About Us</h2>
    <p class="container position-relative d-grid gap-3 text-center mt-4 border rounded border-0" 
    style="padding: 2% 2% 5% 2%; font-weight: 700; font-size: large; color: #ccead1; background-color: #ffffff1f; 
    box-shadow: 2rem 1.3rem 2.5rem rgb(46, 46, 46);">
        Welcome to Grow Mentor. <br>
        <span></span>
        We're here to help you identify and address leaf diseases in your plants using cutting-edge artificial intelligence technology.
        <br><span></span>
        You can take your plant care to the next level, making gardening and farming more accessible and sustainable for everyone. Join us in cultivating greener, healthier environments one leaf at a time.
    </p>
    <div class="d-flex justify-content-center pt-5"><img src="static/css/images/logo2.png" alt="" style="width: 30%;box-shadow: 2rem .5rem 2.5rem rgb(46, 46, 46);"></div>
</section>    

<!-- Contact Section -->
    <section class="contactWrapper" id="contact" style="background-color: #c9e5cabb;">
        <div class="containerContact container display-block">
            <h2 class="text-center mt-5" style="color: #07270E; font-weight: bold;">Contact Us</h2>
            <form class="contactForm border border-2 d-grid gap-3 p-3" id="contactForm" action="process_form" method="POST">

                <div class="nameEnter d-flex justify-content-center" id="nameEnter">
                    <input type="text" id="name" name="name" placeholder="Enter Your Name" class="inputContact1 w-75 border border-0 p-2">
                </div>
                <div class="phNmbrEnter d-flex justify-content-center" id="phNmbrEnter">
                    <input type="number" id="phNmbr" name="phone_number" placeholder="Enter Your Phone Number" class="inputContact2 w-75 border border-0 p-2">
                </div>
                <div class="messageArea d-flex justify-content-center">
                    <textarea name="message" id="msgBox" cols="30" rows="10" placeholder="Message" class="inputContact3 w-75 border border-0 p-2"></textarea>
                </div>
                <div class="d-flex justify-content-center ">
                    <input type="submit" value="Submit" id="contactBtn" class="cBtn btn btn-success">
                </div>
            </form>
            
        </div>
        <div class="mediaBox" id="mediaBox">
                <div class="mediaLogo d-flex justify-content-end" id="mediaLogo">
                    <img src="./Images/logo2.png" alt="">
                </div>
        </div>
    </section>
    <!--Footer Section -->
    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2023 by GrowMentor | All Right Reserved</p>
        </div>
        <div class="footer-iconTop">
            <a href="#home"><i class='bx bx-chevrons-up text-right'></i></a>
        </div>
    </footer>
   <!-- Scroll  -->
   <script src="https://unpkg.com/scrollreveal"></script>
    <!-- Main js -->
   <script src="static/js/index.js"></script>

   <!-- JavaScript for displaying uploaded image -->
   <script>
    function uploadImage() {
        var input = document.getElementById('chooseFile');
        var img = document.getElementById('toUpld');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                img.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>

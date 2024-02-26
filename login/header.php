<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
            <!-- Header -->
            <div class="mainWrapper sticky navbar" id="main">
            <div class="centerWrapper" id="center">
                <div class="leftWrapper" id="left">
                    <div class="navLogo" id="logoNav">
                        <a href="#home">
                            <img src="./Images/navLogo.png" alt="">
                        </a>
                    </div>
                    <div class="menuWrapper" id="menuW">
                        <ul>
                            <li><a class="active" href="#home">Home</a></li>
                            <li><a href="#service">Service</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="blog.html" target="_blank">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="rightWrapper" id="right">
                    <div class="loginAndSignUp" id="lasp">
                        <ul>
                            <li><a href="./login.html">Login</a></li>
                            <li><a href="./signUp.html" target="_blank">Sign Up</a></li>
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
                  <a  href="#service">Service</a>
                  <a  href="#contact">Contact</a>
                  <a  href="blog.html">Blog</a>
                  <a  href="./login.html#login">Login</a>
                  <a  href="./signUp.html#signUp">Sign Up</a>
                </div>
              </div>
        </div>  
</body>
</html>
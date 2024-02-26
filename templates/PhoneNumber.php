<!DOCTYPE html>
<html>
  <head>
    <title>Phone Verification</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" >
    <link rel="stylesheet" href="main.css" >

  </head>
  <body>
  <form action="verification.php">
      <h1>Phone verification In PHP</h1>
      <div class="formcontainer">
      <hr/>
      <div class="container">
        <label for="uname"><strong>Phone Number</strong></label>
        <input type="text" id="phone_number" placeholder="Enter phone number" name="uname" required>
      </div>
      <div id="recaptcha-container"></div>
      <button type="button" onclick="phoneAuth();">Send Otp</button>

      <div class="formcontainer">
      <hr/>
      <div class="container">
      <input type="text" id="verificationCode" placeholder="Enter verification code">
      </div>
     
      <button type="button" onclick="codeverify();">Verify code</button>
    
    </form>


    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase.js"></script>
    <script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
  apiKey: "AIzaSyBjOM5PiD7YEP1CvTOc1VAAkInq-dUIeTA",
  authDomain: "dreamymirror-eb493.firebaseapp.com",
  projectId: "dreamymirror-eb493",
  storageBucket: "dreamymirror-eb493.appspot.com",
  messagingSenderId: "794456640560",
  appId: "1:794456640560:web:93269fbf90cab6f5d8b1f5",
  measurementId: "G-ZS2R9B66LG"
};

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
     firebase.analytics();
</script>
    <script src="NumberAuthentication.js" type="text/javascript"></script>
  </body>
</html>
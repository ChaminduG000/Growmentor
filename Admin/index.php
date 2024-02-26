
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body {
            background-image: url('images/homebg.jpg'); /* Replace with your image path */
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Adjusted for title placement */
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden; /* Prevent background image overflow */
        }

        .main-title {
            color: #fff; /* Text color for the main title */
            font-size: 24px; /* Adjust the font size as needed */
            margin-bottom: 20px;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            backdrop-filter: blur(10px); /* Apply a blur effect to the background */
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #006400;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #195905; /* Change the background color on hover */
        }
    </style>
</head>
<body>
    <div class="main-title"><font color="black"><b>Growmentor | Plant Disease Management</b></font></div>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="admin_authenticate.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

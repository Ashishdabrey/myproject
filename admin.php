<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/4478925.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin:0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            background-color: rgba(255, 253, 208, 0.95); /* Semi-transparent background */
            width: 400px; /* Fixed width for the form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 5px solid #2c5b4c; 
            height: 300px;
        }
        h2 {
            color: #ff6a80;
            text-align: center;
            margin-bottom: 20px;
            font-size: 35px;
            font-family: cursive;
            margin-top:10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%; /* Full width minus padding */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;

        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color:#2c5b4c;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e05570;
        }
        h3 {
            color: yellow; /* Set the color of <h3> elements to red */
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
        <form action="admin.php" method="post">
            <h2>Admin Login</h2>
            <input type="text" name="username" placeholder="Username"><br/>
            <input type="password" name="password" placeholder="Password"><br/>
            <button name="login">Login</button>
        </form>
    </div>
</body>
</html>
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project.db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pwd = $_POST['password'];

    // Sanitize user inputs
    $username = mysqli_real_escape_string($conn, $username);
    $pwd = mysqli_real_escape_string($conn, $pwd);

    // Query to check credentials
    $query = "SELECT * FROM admin WHERE Username='$username' AND Password='$pwd'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: adminpanel.php");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "<h3>login failed</h3>";
    }
}

mysqli_close($conn);
ob_end_flush(); // Flush output buffer
?>
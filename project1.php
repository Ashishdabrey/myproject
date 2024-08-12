<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Token Message</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        padding: 20px;
    }

    .token-message {
        text-align: center;
        font-size: 24px;
        color: #333;
    }
</style>
</head>
<body>

<div class="token-message">
<?php
session_start(); // Start the session to access session variables
if(isset($_SESSION['token'])&& $_SESSION['name']) {
    $token = $_SESSION['token'];
    $name=$_SESSION['name'];
    echo "<h3>Thank you $name, your token number is</h3>";
    echo "<h1>$token</h1>";
} else {
    echo "Token not found!";
}
session_abort();
?>
</div>

</body>
</html>


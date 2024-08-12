<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurent</title>
</head>
<link rel="shortcut icon" href="images\4478925.jpg" type="image/x-icon">
<style>
    body {
        background-image: url('images/4478925.jpg');
        background-size: cover;
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
    }

    #main {
        display: flex;
        box-sizing: border-box;
        flex-direction: column;
        border: 10px solid #2c5b4c;
        border-radius: 10px;
        width: 30%;
        align-items: center;
        background-color: #FFFDD0;
        height: 300px;
        justify-content: space-between;
        padding: 40px;
    }

    a {
        text-decoration: none;
        font-size: 25px;
    }

    #btn {
        background-color: #2c5b4c;
        color: white;
        border-radius: 5px;
        width: 70%;
        padding: 5px;
        text-align: center;
    }

    #btn:hover {
        background-color: #e05570;
        transform: scale(1.05);
        transition: background-color 0.3s ease-out, transform 0.3s ease-out;
    }

    ::-webkit-scrollbar {
        width: 15px;
        /* Scrollbar ki width */
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Scrollbar track ka background color */
    }

    ::-webkit-scrollbar-thumb {
        background-color: #2c5b4c;
        /* Scrollbar ki thumb ka color */
        border-radius: 6px;
        /* Round corners */
        border: 3px solid #f1f1f1;
        /* Thumb ke ird gird border */
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #e05570;
        /* Hover karne par thumb ka color */
    }
</style>

<body>
    <div id="main">
        <a type="button" id="btn" href="token.php">Generate Tokens</a>
        <a type="button" id="btn" href="">Your Token number</a>
        <a type="button" id="btn" href="admin.php">Admin Panel</a>
    </div>

</body>

</html>
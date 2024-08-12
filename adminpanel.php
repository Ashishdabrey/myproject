<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurent</title>
</head>
<style>
    body {
        background-image: url('images/4478925.jpg');
        background-size: cover;
        /* Ensures the image fits within the viewport */
        background-repeat: repeat;
        /* Repeats the image if it doesn’t cover the entire background */
        display: flex;
        height: 100vh;
        /* Ensures the body height covers the viewport */
        justify-content: center;
        font-family: Arial, sans-serif;
        align-items: center;
    }

    #main {
        display: flex;
        box-sizing: border-box;
        flex-direction: column;
        border: 10px solid #2c5b4c;
        border-radius: 10px;
        width: 60%;
        background-color: #FFFDD0;
        height: auto;
        justify-content: space-between;
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

    a {
        text-decoration: none;
        font-size: 25px;
        width: 20%;
        align-content: center;
        font-weight: bolder;
    }

    #btn {
        background-color: #3f836d;
        color: white;
        border-radius: 5px;
        padding: 10px;
        text-align: center;
    }

    #btn:hover {
        background-color: #e05570;
        transform: scale(1.05);
        transition: background-color 0.3s ease-out, transform 0.3s ease-out;
    }

    #sub-main {
        display: flex;
        justify-content: space-between;
        margin: 70px;

    }
</style>

<body>
    <div id="main">
        <div id="sub-main">
            <a type="button" id="btn" href="Collections.php">Collections</a>
            <a type="button" id="btn" href="token.php">Generate Tokens</a>
            <a type="button" id="btn" href="">Check Token no.</a>
        </div>
        <div id="sub-main">
            <a type="button" id="btn" href="display1.php">Order's Detail</a>
            <a type="button" id="btn" href="Employee.php">Employee Registration</a>
            <a type="button" id="btn" href="Edetails.php">Employee's Details</a>
        </div>
        <!-- <div id="sub-main">
        <a type="button" id="btn" href="">Generate Tokens</a>
        <a type="button" id="btn" href="">Admin Panel</a>
        <a type="button" id="btn" href="">Your Token number</a>
    </div> -->
    </div>

</body>

</html>
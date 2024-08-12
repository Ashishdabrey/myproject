<?php
session_start();
// Database connection parameters
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "project.db";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }


include 'connection.php';
// Check if form is submitted
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkboxes = $_POST['checkboxes'];


    // Prepare selected options and quantities
    $selected_options = array();
    foreach ($checkboxes as $option => $data) {
        if (isset($data['selected']) && $data['selected']) {
            $selected_options[$option] = $data['quantity'];
        }
    }
    $dish_costs = array(
        "Burger" => 50,
        "Cheese Burger" => 80,
        "Veg Momos(half)" => 40,
        "Veg Momos(full)" => 80,
        "Chaowmin(half)" => 40,
        "Chaowmin(full)" => 80,
        "Fried Rice(half)" => 40,
        "Fried Rice(full)" => 80,
        "Spring Roll(full)" => 60,
        "Manchurian" => 60
    );

    $totalCost = 0;
    foreach ($selected_options as $option => $quantity) {
        // Check if the option exists in $dishCosts array

        if (array_key_exists($option, $dish_costs)) {
            // Retrieve the cost of the option from $dishCosts array
            $cost = $dish_costs[$option];

            // Multiply the cost with the quantity and add it to the total cost
            $totalCost += $cost * $quantity;
        }
    }

    // Convert selected options and quantities to JSON format
    $selected_options_json = json_encode($selected_options);

    $phoneno = $_POST['phoneno'];


    // Get current date

    $current_date = date("Y-m-d");

    // Check if token for today already exists
    // Get the last token for the current date
    $sql_last_token = "SELECT token FROM datat WHERE Date = '$current_date' ORDER BY token DESC LIMIT 1";
    $result_last_token = mysqli_query($conn, $sql_last_token);
    if (mysqli_num_rows($result_last_token) > 0) {
        // Fetch the last token and increment it for the next entry
        $row_last_token = mysqli_fetch_assoc($result_last_token);

        $last_token = $row_last_token['token'];
        $token = $last_token + 1;
    } else {
        // If no token exists for the current date, start from 1
        $token = 1;
    }

    // SQL query to insert data into table
    $sql = "INSERT INTO datat (Name, Email, Orders, Date, token, Mobile, Total_cost) VALUES ('$name', '$email', '$selected_options_json', '$current_date', '$token', '$phoneno', '$totalCost')";
    $result = mysqli_query($conn, $sql);
    if ($result === TRUE) {
        // Store token in session to prevent duplicate submissions on refresh
        $_SESSION['token'] = $token;
        $_SESSION['name'] = $name;
        // Redirect to thank you page to avoid form resubmission
        header("Location: project1.php");
        exit(); // Make sure to exit after redirecting
    } else {
        $errors[] = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(images/4478925.jpg);
            background-size: cover;
            height: auto;
            background-position: center;
            opacity: 95%;
        }

        h2 {
            color: #ff6a80;
            text-align: center;
            margin-bottom: 30px;
            font-size: 50px;
            font-family: cursive;

        }

        form {
            background-color: #FFFDD0;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            margin: 0 auto;
            font-size: 20px;
            color: #2c5b4c;
            box-sizing: border-box;
            font-weight: bold;
            border: 5px solid #2c5b4c;
        }

        #name,
        #email,
        #phoneno {
            width: 100%;
            height: 40px;
            padding: 5px;
            margin-bottom: 20px;
            border: 1px solid #2c5b4c;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 20px;
            color: #2c5b4c;
            border: 1px solid #2c5b4c;
        }

        button {
            margin-top: 20px;
            background-color: #40826D;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 25px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            transition: background-color 0.3s ease-out, transform 0.3s ease-out;
        }

        /* Responsive design */
        @media screen and (max-width: 600px) {
            form {
                padding: 20px;
                max-width: 90%;
            }
        }

        #adminButton {
            position: fixed;
            top: 0;
            left: 0;
            width: 80px;
            height: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }

        #adminButton:hover {
            background-color: #2c5b4c;
        }

        .order {
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            margin-bottom: -10px;
        }

        .order input[type="number"] {
            margin-left: auto;
            /* Push the number input to the right */
            width: 40%;
            border: 1px solid #2c5b4c;
            border-radius: 2px;
            color: #2c5b4c;
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
</head>

<body>
    <h2>Generate your token</h2>
    <a type="button" id="adminButton" href="admin.php" target="_blank">Admin</a>
    <form action="token.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>


        <label for="phoneno">Mobile No.:</label><br>
        <input type="tel" id="phoneno" name="phoneno" required><br>
        <div class="main">
            <label>Menu:</label><br>
            <label for="option1" class="order">
                <input type="checkbox" id="option1" name="checkboxes[Burger][selected]" value="1"> Burger
                <input type="number" id="quantity1" name="checkboxes[Burger][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option2" class="order">
                <input type="checkbox" id="option2" name="checkboxes[Cheese Burger][selected]" value="1"> Cheese Burger
                <input type="number" id="quantity2" name="checkboxes[Cheese Burger][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option3" class="order">
                <input type="checkbox" id="option3" name="checkboxes[Veg Momos(half)][selected]" value="1"> Veg Momos(half)
                <input type="number" id="quantity3" name="checkboxes[Veg Momos(half)][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option4" class="order">
                <input type="checkbox" id="option4" name="checkboxes[Veg Momos(full)][selected]" value="1"> Veg Momos(full)
                <input type="number" id="quantity4" name="checkboxes[Veg Momos(full)][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option5" class="order">
                <input type="checkbox" id="option5" name="checkboxes[Chaowmin(half)][selected]" value="1"> Chaowmin(half)
                <input type="number" id="quantity5" name="checkboxes[Chaowmin(half)][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option6" class="order">
                <input type="checkbox" id="option6" name="checkboxes[Chaowmin(full)][selected]" value="1"> Chaowmin(full)
                <input type="number" id="quantity6" name="checkboxes[Chaowmin(full)][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option7" class="order">
                <input type="checkbox" id="option7" name="checkboxes[Fried Rice(half)][selected]" value="1"> Fried Rice(half)
                <input type="number" id="quantity7" name="checkboxes[Fried Rice(half)][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option8" class="order">
                <input type="checkbox" id="option8" name="checkboxes[Fried Rice(full)][selected]" value="1"> Fried Rice(full)
                <input type="number" id="quantity8" name="checkboxes[Fried Rice(full)][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option9" class="order">
                <input type="checkbox" id="option9" name="checkboxes[Spring Roll(full)][selected]" value="1"> Spring Roll(full)
                <input type="number" id="quantity9" name="checkboxes[Spring Roll(full)][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
            <label for="option10" class="order">
                <input type="checkbox" id="option10" name="checkboxes[Manchurian][selected]" value="1"> Manchurian
                <input type="number" id="quantity10" name="checkboxes[Manchurian][quantity]" placeholder="quantity" min="1" max="100" value="1">
            </label><br>
        </div>


        <button name="submit" type="submit">Generate Token</button>
    </form>

</body>

</html>
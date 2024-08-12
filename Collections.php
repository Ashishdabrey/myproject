<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project.db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$current_date = date('Y-m-d');
$Todays_total = "SELECT SUM(Total_cost) AS total_sum FROM datat WHERE Date = '$current_date' AND Status='done'";
$Result_Todays_total = mysqli_query($conn, $Todays_total);
$Total = 0;
if ($Result_Todays_total) {
    // Fetch the result
    $total = mysqli_fetch_assoc($Result_Todays_total);
    if ($total['total_sum'] !== null) {
        $Total = $total['total_sum'];
    }
}
// else
// {
//     echo "no element";
// }

$Monthly_total = "SELECT SUM(Total_cost) AS total_sum FROM datat WHERE Month(date) = Month(current_date) AND Status='done'";
$result_Monthly_total = mysqli_query($conn, $Monthly_total);
$Total2 = 0;
if ($result_Monthly_total) {
    // Fetch the result
    $total = mysqli_fetch_assoc($result_Monthly_total);
    if ($total['total_sum'] !== null) {
        $Total2 = $total['total_sum'];
    }
}
// else
// {
//     echo "no element";
// }

$yearly_total =  "SELECT SUM(Total_cost) AS total_sum FROM datat WHERE YEAR(date)=year(current_date) AND status='done'";
$result_yearly_total = mysqli_query($conn, $yearly_total);
$Total3 = 0;
if ($result_yearly_total) {
    $total = mysqli_fetch_assoc($result_yearly_total);
    if ($total['total_sum'] !== null) {
        $Total3 = $total['total_sum'];
        // echo $Total3;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections</title>
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
        }

        #main {
            box-sizing: border-box;
            border: 10px solid #2c5b4c;
            border-radius: 10px;
            width: auto;
            background-color: #FFFDD0;
            padding: 60px;
            height: fit-content;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        #Order {
            display: flex;
            width: auto;

        }

        #orderstatus {
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            margin: 30px;
            justify-content: space-between;
            width: auto;
            align-items: center;

        }

        h1 {
            font-size: 60px;
            color: #2c5b4c;
            margin: 0px;
        }

        h2 {
            font-size: 70px;
            color: #e05570;
        }

        h3 {
            color: #2c5b4c;
            font-size: 30px;
        }

        h4 {
            color: #e05570;
            font-size: 30px;
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
                let currentNumber1 = 0;
                let currentNumber2 = 0;
                let currentNumber3 = 0;
                let currentNumber4 = 0;

                const TotalTarget1 = <?php echo $Total; ?>;
                const TotalTarget2 = <?php echo $Total2; ?>;
                const TotalTarget3 = <?php echo $Total3; ?>;
                // const TotalTarget4 


                const NumberDisplay1 = document.getElementById('Tcollection');
                const NumberDisplay2 = document.getElementById('Tcollection2');
                const NumberDisplay3 = document.getElementById('Tcollection3');

                function incrementNumber1() {
                    if (currentNumber1 < TotalTarget1) {
                        currentNumber1 = Math.min(currentNumber1 + 10, TotalTarget1);
                        NumberDisplay1.textContent = currentNumber1;
                    } else {
                        clearInterval(interval1);
                    }
                }
                if (TotalTarget1 > 0) {
                    const interval1 = setInterval(incrementNumber1, 1);
                } else {
                    NumberDisplay1.textContent = '0';
                }


                function incrementNumber2() {
                    if (currentNumber2 < TotalTarget2) {
                        currentNumber2 = Math.min(currentNumber2 + 10, TotalTarget2);
                        NumberDisplay2.textContent = currentNumber2;
                    } else {
                        clearInterval(interval2);
                    }
                }
                const interval2 = setInterval(incrementNumber2, 0.05);


                function incrementNumber3() {
                    if (currentNumber3 < TotalTarget3) {
                        currentNumber3 = Math.min(currentNumber3 + 100, TotalTarget3);
                        NumberDisplay3.textContent = currentNumber3;
                    } else {
                        clearInterval(interval3);
                    }
                }
                const interval3 = setInterval(incrementNumber3, 0.05);

            }











        );
    </script>

    <div id="main">
        <h1>Today's Collection</h1>
        <h2 id="Tcollection"></h2>
        <h1>This Month</h1>
        <h2 id="Tcollection2"></h2>
        <h1>This Year</h1>
        <h2 id="Tcollection3"></h2>
        <h1>Total Orders</h1>
        <div id="Order">
            <div id="orderstatus">
                <h3>Done</h3>
                <h4>456</h4>

            </div>
            <div id="orderstatus">
                <h3>Not Done</h3>
                <h4>342</h4>
            </div>

        </div>

        <h1>Total Employees</h1>
        <div id="Order">
            <div id="orderstatus">
                <h3>Active</h3>
                <h4>456</h4>

            </div>
            <div id="orderstatus">
                <h3>Inactive</h3>
                <h4>342</h4>
            </div>

        </div>
    </div>
</body>

</html>
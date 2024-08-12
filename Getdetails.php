<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
        body {
            background-image: url('images/4478925.jpg');
            background-size: cover;
            background-repeat: repeat;
            display: flex;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        #main {
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            min-width: 60%;
            width: fit-content;
            height: fit-content;
            position: relative;
            align-items: center;
        }

        table {
            width: 100%;
            border: 5px solid #2c5b4c;
            border-collapse: collapse;

        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border: 1px solid #2c5b4c;
        }

        th {
            background-color: #f2f2f2;
            width: 40%;
        }


        #profilepic {
            position: absolute;
            top: 92px;
            right: 25px;
            background-color: white;
            border-bottom: 5PX SOLID #2c5b4c;
            border-left: 5PX SOLID #2c5b4c;
            width: 150px;
            /* Fixed width */
            height: 145px;
            /* Fixed height */
        }

        #profilepic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image covers the entire container */
        }

        strong {
            color: #2c5b4c;
        }

        H2 {
            text-align: center;
        }

        button {
            color: white;
            background-color: #2c5b4c;
            padding: 10px;
            border-radius: 5px;
            font-size: larger;
            margin-top: 20px;
        }

        button:hover {
            background-color: #e05570;
            transform: scale(1.05);
            transition: background-color 0.3s ease-out, transform 0.3s ease-out;

        }

        .Active {
            font-size: larger;
            font-weight: bolder;
            color: green;
        }

        .Inactive {
            font-size: larger;
            font-weight: bolder;
            color: red;
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
    <?php
    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $employee_id = $_POST['Employee_id'];

        $getdetails = "SELECT * FROM employees WHERE ID='$employee_id'";
        $result = mysqli_query($conn, $getdetails);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $Employee_id = $row['ID'];
            $name = $row['Name'];
            $fname = $row['Fathername'];
            $email = $row['Email'];
            $phone = $row['Phone'];
            $address = $row['Address'];
            $dob = $row['DOB'];
            $age = $row['Age'];
            $position = $row['Position'];
            $doj = $row['DOJ'];
            $account = $row['Account'];
            $aadhar = $row['adhar'];
            $profilePic = $row['Profilepic']; // Assuming you have a column for profile picture
            $DOE = $row['DOE'];
            $status = $row['Status'];
        } else {
            echo "No employee found with the provided ID.";
            exit;
        }
    } else {
        echo "Invalid request.";
        exit;
    }

    mysqli_close($conn);
    ?>

    <div id="main">
        <h2>FULL DETAILS</h2>
        <div id="profilepic">
            <?php if ($profilePic) : ?>
                <img src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile Picture">
            <?php else : ?>
                No picture uploaded.
            <?php endif; ?>
        </div>
        <table>
            <tr>
                <th>EMPLOYEE ID</th>
                <td><?php echo htmlspecialchars($Employee_id); ?></td>

            </tr>
            <tr>
                <th>NAME</th>
                <td><?php echo htmlspecialchars($name); ?></td>

            </tr>
            <tr>
                <th>FATHER'S NAME</th>
                <td><?php echo htmlspecialchars($fname); ?></td>

            </tr>
            <tr>
                <th>EMAIL</th>
                <td><?php echo htmlspecialchars($email); ?></td>

            </tr>
            <tr>
                <th>MOBILE NO.</th>
                <td><?php echo htmlspecialchars($phone); ?></td>

            </tr>
            <tr>
                <th>ADDRESS</th>
                <td><?php echo htmlspecialchars($address); ?></td>

            </tr>
            <tr>
                <th>DATE OF BIRTH</th>
                <td><?php echo htmlspecialchars($dob); ?></td>

            </tr>
            <tr>
                <th>AGE</th>
                <td><?php echo htmlspecialchars($age); ?></td>

            </tr>
            <tr>
                <th>POSITION</th>
                <td><?php echo htmlspecialchars($position); ?></td>

            </tr>
            <tr>
                <th>DATE OF JOINING</th>
                <td><?php echo htmlspecialchars($doj); ?></td>

            </tr>
            <tr>
                <th>ACCOUNT NO.</th>
                <td><?php echo htmlspecialchars($account); ?></td>

            </tr>
            <tr>
                <th>AADHAAR</th>
                <td><?php echo htmlspecialchars($aadhar); ?></td>

            </tr>
            <tr>
                <th>DOE</th>
                <td><?php echo htmlspecialchars($DOE); ?></td>

            </tr>
            <tr>
                <th>STATUS</th>
                <td class='<?php echo $status == 'Active' ? 'Active' : 'Inactive'; ?>'> <?php echo htmlspecialchars($status); ?></td>

            </tr>

        </table>
        <div>
            <button type="button" onclick="window.print()">PRINT</button>
        </div>

    </div>
</body>

</html>
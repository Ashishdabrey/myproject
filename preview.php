<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $fname = $_POST['fathername'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $doj = $_POST['date'];
    $account = $_POST['bank-account'];
    $aadhar = $_POST['aadhaar'];


    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }


    if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] == 0) {
        $profilePic = $uploadDir . basename($_FILES['profile-pic']['name']);
        if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $profilePic)) {
            $profilePic = htmlspecialchars($profilePic);
        } else {
            $profilePic = null;
            echo "Failed to upload file.";
        }
    } else {
        $profilePic = null;
    }
}

?>

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

        #btn {
            display: flex;
            justify-content: space-evenly;
            margin-top: 20px;
        }

        button {
            color: white;
            background-color: #2c5b4c;
            padding: 10px;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: larger;
        }

        button:hover {
            background-color: #e05570;
            transform: scale(1.05);
            transition: background-color 0.3s ease-out, transform 0.3s ease-out;

        }
    </style>
</head>

<body>

    <div id="main">
        <form action="submit.php" method="post">
            <h2>PREVIEW DETAILS</h2>
            <div id="profilepic">
                <?php if ($profilePic) : ?>
                    <img src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile Picture">
                <?php else : ?>
                    No picture uploaded.
                <?php endif; ?>
            </div>
            <table>
                <tr>
                    <th>NAME</th>
                    <td><?php echo htmlspecialchars($name); ?></td>
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </tr>
                <tr>
                    <th>FATHER'S NAME</th>
                    <td><?php echo htmlspecialchars($fname); ?></td>
                    <input type="hidden" name="fathername" value="<?php echo htmlspecialchars($fname); ?>">
                </tr>
                <tr>
                    <th>EMAIL</th>
                    <td><?php echo htmlspecialchars($email); ?></td>
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </tr>
                <tr>
                    <th>MOBILE NO.</th>
                    <td><?php echo htmlspecialchars($phone); ?></td>
                    <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                </tr>
                <tr>
                    <th>ADDRESS</th>
                    <td><?php echo htmlspecialchars($address); ?></td>
                    <input type="hidden" name="address" value="<?php echo htmlspecialchars($address); ?>">
                </tr>
                <tr>
                    <th>DATE OF BIRTH</th>
                    <td><?php echo htmlspecialchars($dob); ?></td>
                    <input type="hidden" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
                </tr>
                <tr>
                    <th>AGE</th>
                    <td><?php echo htmlspecialchars($age); ?></td>
                    <input type="hidden" name="age" value="<?php echo htmlspecialchars($age); ?>">
                </tr>
                <tr>
                    <th>POSITION</th>
                    <td><?php echo htmlspecialchars($position); ?></td>
                    <input type="hidden" name="position" value="<?php echo htmlspecialchars($position); ?>">
                </tr>
                <tr>
                    <th>DATE OF JOINING</th>
                    <td><?php echo htmlspecialchars($doj); ?></td>
                    <input type="hidden" name="doj" value="<?php echo htmlspecialchars($doj); ?>">
                </tr>
                <tr>
                    <th>ACCOUNT NO.</th>
                    <td><?php echo htmlspecialchars($account); ?></td>
                    <input type="hidden" name="account" value="<?php echo htmlspecialchars($account); ?>">
                </tr>
                <tr>
                    <th>AADHAAR</th>
                    <td><?php echo htmlspecialchars($aadhar); ?></td>
                    <input type="hidden" name="aadhar" value="<?php echo htmlspecialchars($aadhar); ?>">
                </tr>
                <input type="hidden" name="profilepic" value="<?php echo htmlspecialchars($profilePic); ?>">


            </table>
            <div id="btn">
                <button type="submit">SUBMIT</button>
                <button type="button" onclick="window.history.back();">EDIT</button>
            </div>
        </form>
    </div>
</body>

</html>
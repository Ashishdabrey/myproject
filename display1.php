<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <style>
        body {
            background-image: url(images/4478925.jpg);
            background-size: cover;
            align-items: center;
            justify-content: center;
        }

        /* For Webkit browsers like Chrome, Safari */
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

        table {
            background-color: #FFFDD0;
            margin: 0 auto;
            border-radius: 5px;
            border: 5px solid #2c5b4c;
            color: #2c5b4c;
        }

        td:nth-child(1),
        td:nth-child(5),
        td:nth-child(6),
        td:nth-child(8),
        td:nth-child(9),
        td:nth-child(10) {
            text-align: center;
        }

        td {
            font-weight: bolder;
        }

        h1 {
            text-align: center;
            color: yellow;
        }

        th {
            font-size: larger;
            font-weight: bolder;
        }

        .center-button {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 15px;
        }

        .status-button {
            color: white;
            background-color: green;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            margin: 5px;
        }

        .status-button.not-done {
            background-color: red;
        }

        .status-button:hover {
            background-color: darkgreen;
            color: yellow;
        }

        .status-button.not-done:hover {
            background-color: darkred;
            color: yellow;

        }

        .status-done {
            color: green;
            font-size: larger;
            font-weight: bold;
        }

        .status-not-done {
            color: red;
            font-size: larger;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include 'connection.php';

    // $username = $_SESSION['username'];

    // if ($username == true) {
    //     // Continue if the user is authenticated
    // } else {
    //     header("location:admin.php");
    // }

    // Handle order status update
    if (isset($_POST['update_status'])) {
        $order_id = $_POST['order_id'];
        $new_status = $_POST['new_status'];
        $update_query = "UPDATE datat SET Status='$new_status' WHERE ID='$order_id'";
        mysqli_query($conn, $update_query);
    }

    $query = "SELECT * FROM datat";
    $data = mysqli_query($conn, $query);

    $total = mysqli_num_rows($data);

    if ($total != 0) {
    ?>
        <h1>Displaying All Records</h1>
        <table border="1" cellspacing="7" width="100%">
            <tr>
                <th width="3%">ID</th>
                <th width="10%">Name</th>
                <th width="15%">Email</th>
                <th width="25%">Order</th>
                <th width="10%">Date</th>
                <th width="5%">Token</th>
                <th width="7%">Mobile</th>
                <th width="7%">Total Cost</th>
                <th width="7%">Status</th>
                <th width="15%">Action</th>
            </tr>
            <?php
            while ($result = mysqli_fetch_assoc($data)) {
                // Ensure the 'Status' key exists in the result set
                if (!isset($result['Status'])) {
                    $result['Status'] = 'not done';
                }
                $status_class = $result['Status'] == 'done' ? 'status-done' : 'status-not-done';
                echo "<tr id='row-" . $result['ID'] . "'>
        <td>" . $result['ID'] . "</td>
        <td>" . $result['Name'] . "</td>
        <td>" . $result['Email'] . "</td>
        <td>" . $result['Orders'] . "</td>
        <td>" . $result['Date'] . "</td>
        <td>" . $result['token'] . "</td>
        <td>" . $result['Mobile'] . "</td>
        <td>" . $result['Total_cost'] . "</td>
        <td class='$status_class'>" . $result['Status'] . "</td>
        <td>
            <form method='post' action='#row-" . $result['ID'] . "'>
                <input type='hidden' name='order_id' value='" . $result['ID'] . "'>
                <input type='hidden' name='new_status' value='done'>
                <button type='submit' name='update_status' class='status-button' >Mark as Done</button>
            </form>
            <form method='post' action='#row-" . $result['ID'] . "'>
                <input type='hidden' name='order_id' value='" . $result['ID'] . "'>
                <input type='hidden' name='new_status' value='not done'>
                <button type='submit' name='update_status' class='status-button not-done'>Mark as Not Done</button>
            </form>
        </td>
    </tr>";
            }
            ?>
        </table>
        <!-- <div class="center-button">
    <a href="admin.php"><input type="submit" name="logout" value="Logout"></a>
</div> -->
    <?php
    } else {
        echo "Table has no record";
    }
    ?>
</body>

</html>
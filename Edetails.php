<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee details</title>
    <style>
        body {
            background-image: url(images/4478925.jpg);
            background-size: cover;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        table {
            background-color: #FFFDD0;
            margin: 0 auto;
            border-radius: 5px;
            border: 5px solid #2c5b4c;
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

        td:nth-child(1),
        td:nth-child(4),
        td:nth-child(5),
        td:nth-child(6),
        td:nth-child(7),
        td:nth-child(8),
        td:nth-child(9),
        td:nth-child(10),
        td:nth-child(11),
        td:nth-child(12) {
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

        /* .center-button {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 15px;
        } */

        .status-button {
            color: white;
            background-color: #326857;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            margin: 5px;
        }

        /* .status-button.not-done {
            background-color: red;
        } */

        .status-button:hover {
            background-color: #2c5b4c;
            /* color: yellow; */
            transform: scale(1.1);
            transition: background-color 0.3s ease-out, transform 0.3s ease-out;

        }

        /* .status-button.not-done:hover {
            background-color: darkred;
            color: yellow;

        } */

        /* .status-done {
            color: green;
            font-weight: bold;
        }

        .status-not-done {
            color: red;
            font-weight: bold;
        } */

        .status-button.inactive {
            background-color: #d3d3d3;
            color: #a9a9a9;
            cursor: not-allowed;
        }

        .color {
            color: green;
            font-size: large;
            font-weight: bolder;
        }

        .color.inactive-row {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include 'connection.php';

    // Handle order status update
    $current_date = date("Y-m-d");
    if (isset($_POST['update_status'])) {
        $order_id = $_POST['order_id'];
        $new_status = $_POST['new_status'];

        // Fetch the current status of the employee
        $status_query = "SELECT Status FROM employees WHERE ID='$order_id'";
        $status_result = mysqli_query($conn, $status_query);
        $status_row = mysqli_fetch_assoc($status_result);

        if ($status_row['Status'] != 'Inactive' && $new_status == 'Inactive') {
            // Update DOE only if status is changing to Inactive
            $update_query = "UPDATE employees SET Status='$new_status', DOE='$current_date' WHERE ID='$order_id'";
        } else {
            // Prevent further updates if status is already Inactive
            $update_query = "UPDATE employees SET Status='$new_status' WHERE ID='$order_id'";
        }

        mysqli_query($conn, $update_query);
    }

    $query = "SELECT * FROM employees";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);

    if ($total != 0) {
    ?>
        <h1>Displaying All Records</h1>
        <table border="1" cellspacing="7" width="100%">
            <tr>
                <th width="3%">ID</th>
                <th width="6%">Name</th>
                <th width="8%">Email</th>
                <th width="5%">Phone</th>
                <th width="5%">DOB</th>
                <th width="3%">Age</th>
                <th width="4%">Position</th>
                <th width="5%">DOJ</th>
                <th width="5%">DOE</th>
                <th width="5%">Status</th>
                <th width="8%">Deactivating</th>
                <th width="8%">Details</th>
            </tr>
        <?php
        while ($result = mysqli_fetch_assoc($data)) {
            // Disable the button if status is already inactive
            $button_disabled = ($result['Status'] == 'Inactive') ? 'disabled' : '';
            $button_class = ($result['Status'] == 'Inactive') ? 'status-button inactive' : 'status-button';
            $button_text = ($result['Status'] == 'Inactive') ? 'Deactivated' : 'Deactivate';

            echo "<tr id='row-" . $result['ID'] . "' class='" . ($result['Status'] == 'Inactive' ? 'inactive-row' : '') . "'>
    <td>" . $result['ID'] . "</td>
    <td>" . $result['Name'] . "</td>
    <td>" . $result['Email'] . "</td>
    <td>" . $result['Phone'] . "</td>
    <td>" . $result['DOB'] . "</td>
    <td>" . $result['Age'] . "</td>
    <td>" . $result['Position'] . "</td>
    <td>" . $result['DOJ'] . "</td>
    <td>" . $result['DOE'] . "</td>
   <td class='color " . ($result['Status'] == 'Inactive' ? 'inactive-row' : '') . "'>" . $result['Status'] . "</td>

    <td>
      <form method='post' action='#row-" . $result['ID'] . "'>
                <input type='hidden' name='order_id' value='" . $result['ID'] . "'>
                <input type='hidden' name='new_status' value='Inactive'>
                <button type='submit' name='update_status' class='" . $button_class . "' " . $button_disabled . ">" . $button_text . "</button>
            </form>
            </td>
             <td>
      <form method='post' action='Getdetails.php' target='_blank'>
                 <input type='hidden' name='Employee_id' value='" . $result['ID'] . "'>
                 <button class='status-button'> Get full details</button>
            </form>
            </td>
</tr>";
        }
    } else {
        echo "Table has no record";
    }
        ?>
</body>

</html>
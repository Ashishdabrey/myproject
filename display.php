<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <style>
        body
        {
            background-image: url(images/4478925.jpg);
            background-size: cover;
            align-items: center;
            justify-content:center;
        }
        table{
            background-color: #FFFDD0;
            margin: 0 auto;
            border-radius: 5px;
            border: 5px solid #2c5b4c; 
            color:#2c5b4c;
        }
        td:nth-child(1),
        td:nth-child(5),
        td:nth-child(6),
        td:nth-child(8){
    text-align: center;}
    h1{
        text-align: center;
        color: yellow;
    }
    .center-button {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 15px;
            
        }
        input[type="submit"] {
            background: #FFFDD0;
            color: #2c5b4c;
            padding: 10px 20px;
            border: 3px solid #2c5b4c;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

    </style>
</head>
<body>
    



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
$username=$_SESSION['username'];

if($username==true){

}else{
    header("location:admin.php");
}

$query = "SELECT * from datat";
$data = mysqli_query($conn,$query);

$total = mysqli_num_rows($data);   

if($total!= 0){
    ?>
<h1>Displaying All Records</h1>

    <table border="1" cellspacing ="7" width="100%">
        <tr>
<th width="2%">ID</th>
<th width="10%">Name</th>
<th width="15%">Email</th>
<th width="25%">Order</th>
<th width="10%">Date</th>
<th width="5%">Token</th>
<th width="7%">Mobile</th>
<th width="7%">Total Cost</th>
<th width="15%">Action</th>
</tr>

    <?php



    while ($result = mysqli_fetch_assoc($data)) {
        echo  "<tr>
        <td>".$result['ID']."</td>
        <td>".$result['Name']."</td>
        <td>".$result['Email']."</td>
        <td>".$result['Orders']."</td>
        <td>".$result['Date']."</td>
        <td>".$result['token']."</td>
        <td>".$result['Mobile']."</td>
        <td>".$result['Total_cost']."</td>
        
</tr>";

    }
    
}
else {
    echo " table has no record";
}

?>
</table>
<div class="center-button">
    <a href="admin.php"><input type="submit" name="logout" value="Logout"></a>
</div>
</body>
</html>
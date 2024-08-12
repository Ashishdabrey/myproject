<?php
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"]=="POST"){

    $name=$_POST['name'];
    $fname=$_POST['fathername'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $dob=$_POST['dob'];
    $age=$_POST['age'];
    $position=$_POST['position'];
    $doj=$_POST['doj'];
    $account=$_POST['account'];
    $aadhar=$_POST['aadhar'];
    $profilepic=$_POST['profilepic'];


    $adharcount= "SELECT COUNT(*) AS count FROM employees WHERE adhar='$aadhar'";
    $result_adharcount= mysqli_query($conn,$adharcount);
    $row=mysqli_fetch_assoc($result_adharcount);


    if($row['count']>0){
        echo "This id is already register Please register from different id";
        
    }
    else{
        $insertdata= "INSERT INTO employees (Name, Fathername, Email,Phone,Address,DOB,Age,Position,DOJ,Account,adhar,Profilepic) values ('$name','$fname','$email','$phone','$address','$dob','$age','$position','$doj','$account','$aadhar','$profilepic')";
        $result_insertdata= mysqli_query($conn,$insertdata);

        if ($result_insertdata) {
            // Redirect with a query parameter indicating success
            header("Location: Employee.php?status=success");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    $conn->close();
}

// Close the connection

?>
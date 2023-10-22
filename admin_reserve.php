<?php

include("connection.php");

if(isset($_POST['add_reservation'])){
    $name=$_POST['name'];
    $phone_number=$_POST['phone_number'];
    $email=$_POST['email'];
    $time=$_POST['time'];
    $date=$_POST['date'];
    $capacity=$_POST['capacity'];

    $sql="INSERT INTO `reservations`(name, phone_number, email, time, date, capacity) VALUES('$name','$phone_number','$email','$time','$date','$capacity')";
     if(mysqli_query($conn,$sql)){
        $message[]='New reservation has been made';
     }else{
        $message[]='Error in making reservation';
     }
};


if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $delete_query=mysqli_query($conn,"DELETE FROM `reservations` WHERE id= $delete_id") or die('query failed');
    if($delete_query){

header('location:admin.php');
        $message[]='record has been deleted';
    }else{
        header('location:admin.php');
        $message[]='record could not be deleted';
    };
};
if(isset($_POST['update_reservation'])){
    $update_id=$_POST['update_id'];
    $update_name=$_POST['update_name'];
    $update_phone_number=$_POST['update_phone_number'];
    $update_email=$_POST['update_email'];
    $update_time=$_POST['update_time'];
    $update_date=$_POST['update_date'];
    $update_capacity=$_POST['update_capacity'];

    $update_query=mysqli_query($conn, "UPDATE `reservations` SET name='$update_name', phone_number='$update_phone_number', email='$update_email',time='$update_time', date='$update_date', capacity='$update_capacity' WHERE id='$update_id'");

    if($update_query($conn,$sql)){
        header('location:admin.php');
        $message[]='Record has been updated';

    }else{
        header('location:admin.php');
        $message[]='Error in updating record';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="pic.jpg">
   <style>
      <?php include '.\css\style.css'; ?>
   </style>

</head>

<body>

   <?php

   if (isset($message)) {
      foreach ($message as $message) {
         echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
      };
   };

   ?>

   <?php include 'header.php'; ?>

   <div class="container">

      <body bgcolor=#252837>
<?php

include("connection.php");

if(isset($_POST['add_reservation'])){
    $name=$_POST['name'];
    $phone_number=$_POST['phone_number'];
    $email=$_POST['email'];
    $time=$_POST['time'];
    $date=$_POST['date'];
    $capacity=$_POST['capacity'];

    $insert_query=mysqli_query($conn,"INSERT INTO `reservations`(name, phone_number, email, time_made, date_made, quantity) VALUES('$name','$phone_number','$email','$time','$date','$capacity')");

    if($insert_query){
        $message[]='reservation created';
    }else{
        $message[]='try again';
    }
};

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href=".\css\reservation.css">
    <link rel="stylesheet" href=".\css\style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="pic.jpg">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <style>

    </style>
</head>
<body>
    <div class="wrapper">
        <!-----Top menu--------->
        <div class="section">
            <div class="top-navbar">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>
</a>
</div>
</div>
</div>

<div class="sidebar">
    <!---profile image & text---->
    <div class="profile">
        <img src="images\thaitanic.jpeg" alt="logo">
        <h2 style="color:white">Reservations Dashboard</h2>

</div>

<!-----menu item-------->
<ul>
    <li>
        <a href="reservations.php">
            <span class="icon"><i class="bi-plus-circle-fill"></i></span>
            <span class="item">Add Reservation</span>
</a>
</li>

<li>
        <a href="reservationsview.php">
            <span class="icon"><i class="bi bi-eye-fill"></i></span>
            <span class="item">View Reservations</span>
</a>
</li>

<li>
        <a href="reservationsedit.php">
            <span class="icon"><i class="bi bi-tools"></i></span>
            <span class="item">Update Reservations</span>
</a>
</li>

<li>
        <a href="reservationsdelete.php">
            <span class="icon"><i class="bi bi-trash-fill"></i></span>
            <span class="item">Delete Reservations</span>
</a>
</li>

<li>
        <a href="reservationsreport.php">
            <span class="icon"><i class="fas fa-chart-line"></i></span>
            <span class="item">Reports</span>
</a>
</li>

<li>
<a href="admin.php">
<span class="icon"><i class="fas fa-user-shield"></i></span>
<span class="item">Admin</span>
</a>
</li>

</ul>
</div>
</div>

<div class="section">
    <section>

    <form action=""  method="post" class="add-product-form" enctype="multipart/form-data">
        <?php
        
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display=`none`;"></i></div>';
            };

        };

        ?>

        <h3>Add Reservation</h3>

        <input type="text" name="name" placeholder="name" class="box" required><br>
        <input type="number" name="phone_number" placeholder="phone number" class="box" required><br>
        <input type="text" name="email" placeholder="E-mail address" class="box" required><br>
        <input type="time" name="time" placeholder="time" class="box" required><br>
        <input type="date" name="date" placeholder="date" class="box" required><br>
        <input type="number" name="capacity" min="0" max="5" placeholder="guests" class="box" required><br>
        <input type="submit" value="Make a reservation" name="add_reservation" class="btn">
    </form>

    </section>
    </div>
    </div>

    <!------custom js file link--------->
    <script src="js/script.js"></script>
    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function() {
            document.querySelector("body").classList.toggle("active");
        })
    </script>




</body>

    </html>

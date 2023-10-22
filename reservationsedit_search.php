<?php
include('connection.php');

if(isset($_POST['update_reservation'])){
    $update_id=$_POST['update_id'];
    $update_name=$_POST['update_name'];
    $update_phone_number=$_POST['update_phone_number'];
    $update_email=$_POST['update_email'];
    $update_time=$_POST['update_time'];
    $update_date=$_POST['update_date'];
    $update_capacity=$_POST['update_capacity'];

    $update_query=mysqli_query($conn, "UPDATE `reservations` SET name='$update_name', phone_number='$update_phone_number', email='$update_email',time_made='$update_time', date_made='$update_date', quantity='$update_capacity' WHERE id='$update_id'");

    if($update_query($conn,$sql)){
        header('location:reservationsedit.php');
        $message[]='Record has been updated';

    }else{
        header('location:reservationsedit.php');
        $message[]='Error in updating record';
    }
}
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

<div class="search" style=" float:right; margin:7px; margin-left:700px;">
                        <form action="reservationsedit_search.php" method="POST">
                            <input required type="text" value="<?php if (isset($_POST['search'])) {  echo $_POST['search']; } ?>" name="search" autocomplete="off" style="width:300px; height:30px; margin:auto; padding:5px; border-radius:25px; border: none; " placeholder=" search..." name="search">
                              <button type="submit" name="submit-search" style="background-color: transparent; float: right; padding:0; margin:auto; border:none; padding-left:8px;">  <i style=" color:whitesmoke;cursor: pointer; font-size: 18px;" class="bi bi-search">
                                </i></button>
                        </form>
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
        <a href="reservations.php" class="active">
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

<div class="container">
    <body>
        <section class="shopping-cart">
            <h1 class="heading" style="margin-left:180px;">Update Reservations</h1>
            <div class="add-product-form" style="background-image: none;">

            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
                };
            };

            ?>

        </div>

        <table style="margin-left: 150px;">

        <thead>
<th>Name</th>
<th>Phone Number</th>
<th>E-mail</th>
<th>Time</th>
<th>Date</th>
<th>Guests</th>
<th>Action</th>
        </thead>

        <tbody>

        <?php
    $select_records=mysqli_query($conn,"SELECT * FROM `reservations`");
    if(mysqli_num_rows($select_records)>0){
        while($row=mysqli_fetch_assoc($select_records)){
            ?>

            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone_number']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['capacity']; ?></td>
                <td>
                    <a href="reservationsedit.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i>update</a>
        </td>
        </tr>

        <?php
        };

    }else{
        echo"<div class='empty'> no record to edit</div>";
    };

    ?>
    </tbody>
</table>

</section>

<section class="edit-form-container">
    <?php

    if(isset($_GET['edit'])){
        $edit_id=$_GET['edit'];
        $edit_query=mysqli_query($conn, "SELECT * FROM `reservations` WHERE id=$edit_id");
        if(mysqli_num_rows($edit_query)>0){
            while($fetch_edit=mysqli_fetch_assoc($edit_query)){
                ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                    <input type="text" class="box" required name="update_name" value="<?php echo $fetch_edit['name']; ?>">
                    <input type="number" class="box" required name="update_phone_number" value="<?php echo $fetch_edit['phone_number']; ?>">
                    <input type="text" class="box" required name="update_email" value="<?php echo $fetch_edit['email']; ?>">
                    <input type="time" class="box" required name="update_time" value="<?php echo $fetch_edit['time']; ?>">
                    <input type="date" class="box" required name="update_date" value="<?php echo $fetch_edit['date']; ?>">
                    <input type="number" min="0" max="6" class="box" required name="update_capacity" value="<?php echo $fetch_edit['capacity']; ?>">
                    <input type="submit" value="update record" name="update_reservation" class="btn">
                    <input type="reset" value="cancel" id="close-edit" class="option-btn">
            </form>

            <?php
            };
        };
        echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
                };
                ?>

            </section>

    </div>




    <!-- custom js file link  -->
    <script>
        document.getElementById("close-edit").onclick = myFunction;

        function myFunction() {
            document.querySelector('.edit-form-container').style.display = "none";
        }
    </script>
    <script src="js/script.js"></script>
    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function() {
            document.querySelector("body").classList.toggle("active");
        })
    </script>
</body>

</html>
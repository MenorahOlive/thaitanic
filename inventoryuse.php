<?php
@include 'config.php';

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_units = $_POST['update_p_units'];
    $update_p_quantity = $_POST['update_p_quantity'];
    $update_total = $update_p_quantity - $update_p_units;


   
    if ($update_total >= 0) {
        $update_query = mysqli_query($conn, "UPDATE `inventory` SET  quantity = '$update_total' WHERE id = '$update_p_id'");

       


        $message[] = 'unit removed succesfully';
        header('location:inventoryuse.php');
    } else {

        $message[] = 'unit could not be removed';
        header('location:inventoryuse.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href=".\css\inventory.css">
    <link rel="stylesheet" href=".\css\style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="pic.jpg">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <style>

    </style>
</head>

<body>

    <div class="wrapper">
        <!--Top menu -->
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>

                    </a>
                    <div class="search" style=" float:right; margin:7px; margin-left:700px;">
                        <form action="inventoryuse_search.php" method="POST">
                            <input required type="text" value="<?php if (isset($_POST['search'])) {  echo $_POST['search']; } ?>" name="search" autocomplete="off" style="width:300px; height:30px; margin:auto; padding:5px; border-radius:25px; border: none; " placeholder=" search..." name="search">
                              <button type="submit" name="submit-search" style="background-color: transparent; float: right; padding:0; margin:auto; border:none; padding-left:8px;">  <i style=" color:whitesmoke;cursor: pointer; font-size: 18px;" class="bi bi-search">
                                </i></button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        <div class="sidebar">
            <!--profile image & text-->
            <div class="profile">
                <img src="images\thaitanic.jpeg" alt="logo">
                <h2 style="color:white">Inventory Dashboard</h2>

            </div>
            <!--menu item-->
            <ul>
                <li>
                    <a href="inventory.php">
                        <span class="icon"><i class="bi-plus-circle-fill"></i></span>
                        <span class="item">Add Item</span>
                    </a>
                </li>
                <li>
                    <a href="inventoryview.php">
                        <span class="icon"><i class="bi bi-eye-fill"></i></span>
                        <span class="item">View Item</span>
                    </a>
                </li>
                <li>
                    <a href="inventoryedit.php" >
                        <span class="icon"><i class="bi bi-tools"></i></span>
                        <span class="item">Update Item</span>
                    </a>
                </li>
                <li>
                    <a href="inventorydelete.php">
                        <span class="icon"><i class="bi bi-trash-fill"></i></span>
                        <span class="item">Delete Item</span>
                    </a>
                </li>
                <li>
                    <a href="inventoryuse.php" class="active">
                        <span class="icon"><i class="bi bi-basket"></i></span>
                        <span class="item">Use Stock</span>
                    </a>
                </li>

                <li>
                    <a href="inventoryreport.php">
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

                <h1 class="heading" style="margin-left: 180px;">Use Stock</h1>
                <div class="add-product-form" style="background-image: none;">
                    <?php

                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
                        };
                    };

                    ?>
                </div>

                <table style="margin-left: 200px;">

                    <thead>
                        <th>image</th>
                        <th>name</th>
                        <th>category</th>
                        <th>units left in stock</th>
                        <th>action</th>
                    </thead>

                    <tbody>
                        <?php

                        $select_products = mysqli_query($conn, "SELECT * FROM `inventory`");
                        if (mysqli_num_rows($select_products) > 0) {
                            while ($row = mysqli_fetch_assoc($select_products)) {
                        ?>

                                <tr>
                                    <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['quantity']; ?> units</td>

                                    <td>
                                        <a href="inventoryuse.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-hand-point-left"></i><div>Use Stock</div> </a>
                                    </td>
                                </tr>

                        <?php
                            };
                        } else {
                            echo "<div class='empty'>no items to edit</div>";
                        };
                        ?>
                    </tbody>
                </table>


            </section>

            <section class="edit-form-container">

                <?php

                if (isset($_GET['edit'])) {
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `inventory` WHERE id = $edit_id");
                    if (mysqli_num_rows($edit_query) > 0) {
                        while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
                ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" style="border-radius: 30px; border: 5px solid #e97d6b; padding:2px;" height="100" alt="">
                                <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                                <input disabled type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                                <input disabled type="text" class="box" required name="update_p_category" value="<?php echo $fetch_edit['category']; ?>">
                                <input type="hidden" min="0" class="box" required name="update_p_quantity" value="<?php echo $fetch_edit['quantity']; ?>">
                                <input type="number" min="0" class="box" required name="update_p_units" value="" placeholder="input amount to remove...">

                                <input type="submit" value="remove from stock" name="update_product" class="btn">
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
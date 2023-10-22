<?php
@include 'config.php';
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
                        <form action="inventoryview_search.php" method="POST">
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
                    <a href="inventoryview.php" class="active">
                        <span class="icon"><i class="bi bi-eye-fill"></i></span>
                        <span class="item">View Item</span>
                    </a>
                </li>
                <li>
                    <a href="inventoryedit.php">
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
                    <a href="inventoryuse.php">
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


    <div class="container" style="margin-left: 210px;">


        <section class="products">

            <h1 class="heading">View Purchaced Products</h1>

            <div class="box-container">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `inventory`");
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <div class="box">
                            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" style="max-width: 270px; " alt="">
                            <h3><?php echo $fetch_product['name']; ?></h3>
                            <div class="price">category : <?php echo $fetch_product['category']; ?></div>
                            <div class="price">price : $<?php echo $fetch_product['price']; ?>/-</div>
                            <div class="price">quantity : <?php echo $fetch_product['quantity']; ?> units</div>
                            <div class="price">total : $<?php echo $fetch_product['total']; ?>/-</div>
                        </div>
                <?php
                    };
                };
                ?>
            </div>
        </section>
    </div>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function() {
            document.querySelector("body").classList.toggle("active");
        })
    </script>
</body>

</html>
<?php
@include 'config.php';


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `inventory` WHERE id = $delete_id ") or die('query failed');
    if ($delete_query) {
        
        $message[] = 'product has been deleted';
    } else {
        
        $message[] = 'product could not be deleted';
    };
};
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
                        <form action="inventorydelete_search.php" method="POST">
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
                    <a href="inventoryedit.php">
                        <span class="icon"><i class="bi bi-tools"></i></span>
                        <span class="item">Update Item</span>
                    </a>
                </li>
                <li>
                    <a href="inventorydelete.php" class="active">
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

    <div class="container">

        <body>
            <section class="shopping-cart">

                <h1 class="heading" style="margin-left: 180px;">Search results</h1>
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
                        <th>image</th>
                        <th>name</th>
                        <th>category</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>total price</th>
                        <th>action</th>
                    </thead>

                    <tbody>
                    <?php
                     if (isset($_POST['submit-search'])) {
                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                        $sql = "SELECT * FROM `inventory` WHERE CONCAT( name, category, price, quantity, total) LIKE '%$search%'";
                        $result = mysqli_query($conn , $sql) ;
                        $queryResult = mysqli_num_rows($result) ;
                        ?>
                        <div>
                        <p class="message heading" style="margin-left: 150px; color:black; padding:0px; text-align: center; margin-bottom: 5px;  text-transform:lowercase"><?php echo $queryResult; ?> Results Found</p>
                       </div>

                       <?php
                        if($queryResult > 0){
                            while($row = mysqli_fetch_assoc($result)){?>
                               
                               <tr>
                                    <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td>$<?php echo $row['price']; ?>/-</td>
                                    <td><?php echo $row['quantity']; ?> units</td>
                                    <td>$<?php echo $row['total']; ?>/-</td>

                                    <td>
                                        <a href="inventorydelete.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                                    </td>
                                </tr>
                            <?php
                            } }else{
                               
                        } }?>
                    </tbody>
                </table>


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
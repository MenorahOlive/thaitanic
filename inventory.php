<?php

@include 'config.php';

if (isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $p_category = $_POST['p_category'];
    $p_price = $_POST['p_price'];
    $p_quantity = $_POST['p_quantity'];
    $total = $p_price * $p_quantity;
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/' . $p_image;

    $insert_query = mysqli_query($conn, "INSERT INTO `inventory`(name, category, price, quantity, image, total) VALUES('$p_name', '$p_category', '$p_price', '$p_quantity', '$p_image', '$total')") or die('query failed');

    if ($insert_query) {
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'item added succesfully';
    } else {
        $message[] = 'Invalid entry! Try again';
    }
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
                    <a href="inventory.php" class="active">
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
    <div class="section">
        <section>


            <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
                <?php

                if (isset($message)) {
                    foreach ($message as $message) {
                        echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
                    };
                };

                ?>
                <h3>Add Purchaced Item</h3>

                <input type="text" name="p_name" placeholder="enter the item name" class="box" required>

                <select name="p_category" class="box">
                    <option value="" disabled selected hidden>enter the category</option>
                    <option value="food">Food</option>
                    <option value="drinks">Drinks</option>
                    <option value="equipment">Equipment</option>
                    <option value="housekeeping">House Keeping</option>
                    <option value="utensils">Utensils</option>
                </select>

                <input type="number" name="p_price" min="0" placeholder="enter the item price" class="box" required>
                <input type="number" name="p_quantity" min="0" placeholder="enter the quantity" class="box" required>

                <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
                <input type="submit" value="add the item" name="add_product" class="btn">
            </form>

        </section>

    </div>

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
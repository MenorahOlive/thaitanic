<?php
include ("./get_orders.php")?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href=".\css\inventory.css">
    <link rel="stylesheet" href=".\css\style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="pic.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700&amp;display=swap">
    <link rel="stylesheet" href="./css/cards.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
                <img src="./pic.jpg" alt="logo">
                <h2 style="color:white">Kitchen Dashboard</h2>

            </div>
            <!--menu item-->
            <ul>
            <li>
                    <a href="pending_orders.php">
                        <span class="icon"><i class="bi-plus-circle-fill"></i></span>
                        <span class="item">Pending Orders</span>
                    </a>
                </li>
                <li>
                    <a href="view_orders_page.php" class="hamburger">
                        <span class="icon"><i class="bi bi-eye-fill"></i></span>
                        <span class="item">Completed Orders</span>
                    </a>
                </li>
                <li>
                    <a href="edit-menu.php">
                        <span class="icon"><i class="bi bi-tools"></i></span>
                        <span class="item">Update Menu</span>
                    </a>
                </li>


                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-chart-line"></i></span>
                        <span class="item">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-user-shield"></i></span>
                        <span class="item">Log Out</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="cards_section">
        <section>
            <!-- Main Page -->
                    <?php
                    while($orders = mysqli_fetch_assoc($fetch_orders)){
                        echo("<div class=\"card_wrap\">
                        <form action=\"view-single-order.php\" method=\"POST\" class=\"rForm\">
                        <div class=\"card\">
                        <div class=\"card-body text-center\" style=\"border-width: 0px !important;background: #eaeaea; border-radius: 15px; margin-bottom: 10px;\">
                            <h4 class=\"card-title price-head\">&nbsp;Order  ".$orders["id"]."</h4>
                            <h6 class=\"text-muted card-subtitle mb-2\"></h6>
                            <h1 class=\"price-cost\">".order_status($orders["order_status"])."</h1>
                            <h6 class=\"fs-3 text-muted card-subtitle mb-2 subs\">".$orders["street"]."</h6>
                            <h6 class=\"fs-3 text-muted card-subtitle mb-2 subs\">Waiter: ".$orders["name"]."</h6>
                            <h3>");
                                $order =$orders['total_product'];
                 
                                $ordersSplit = explode(",",$order);
                                foreach($ordersSplit as $item ){
                                    echo($item);
                                    
                                    echo("<br>");
                                }
                                echo("</h3>
                            </form>
                            
                    
                        </div>
                    </div>
                    </div>");
                    }
                       
                    ?>
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

        var allCards = document.querySelectorAll(".price-cost");
        for( var i = 0; i<allCards.length; i++){
            if(allCards[i].innerHTML === "Pending" ){
            allCards[i].style.color = 'red';
            }
        }
    </script>
</body>

</html>
<?php

require("config.php");


$fetch_orders = mysqli_query($conn, "SELECT * FROM `totalorder` where id = ".$_POST['orderID']." ");
$orders = mysqli_fetch_assoc($fetch_orders);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="icon" type="image/x-icon" href="pic.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/css/Recipe-Card.css">
</head>

<body>
    <div class="cont_principal">
        <div class="cont_central">
            <div class="cont_modal cont_modal_active">
                <div class="cont_photo">
                    <div class="cont_img_back"><img src="assets/img/57989f2a2e186e38bf93429aa395120c.jpg"></div>
                    <div class="cont_mins">
                        <div class="sub_mins"></div>
                        <div class="cont_icon_right"><a href="#"><i class="material-icons">bookmark_border</i></a></div>
                    </div>
                    <div class="cont_detalles"></div>
                </div>
                <div class="cont_text_ingredients">
                    <div class="cont_over_hidden">
                        <div class="cont_tabs">
                            <ul>
                                <li><a href="#" style="width: 235.4125px;font-size: 22px;"> Order <?php echo ($orders['id'])?></a></li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="cont_text_det_preparation">
                            <div class="cont_title_preparation">
                            </div>
                            <div class="cont_info_preparation" style="margin-left:45px;text-align:left;">
                                <h3> <?php 
                                $order =$orders['total_product'];
                 
                                $ordersSplit = explode(",",$order);
                                foreach($ordersSplit as $item ){
                                    echo($item);
                                    echo("<br>");
                                }
                                ?></h3>
                            </div>
                            <div class="cont_text_det_preparation">
                                <div class="cont_title_preparation">
                                    <p></p>
                                </div>
                                <div class="cont_info_preparation">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="cont_btn_mas_dets"><a href="#"><i class="material-icons">keyboard_arrow_down</i></a></div>
                    </div>
                    <div class="cont_btn_open_dets"><a href="pending_orders.php" onclick="open_close()"><i class="material-icons">keyboard_arrow_left</i></a></div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
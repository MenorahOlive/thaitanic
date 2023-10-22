<?php

require("config.php");

function order_status($num){
    if($num == 0){
        return "Pending";
    }
    return "Complete";
}

$fetch_orders = mysqli_query($conn, "SELECT * FROM `totalorder` where `order_status` = 0");


?>
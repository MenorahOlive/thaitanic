<?php

require("config.php");

function order_status($num){
    if($num == 0){
        return "Pending";
    }
    if($num == 1)
    {return "Complete";}
    if($num == 2)
    {return "Billed";}
    
}

$fetch_orders = mysqli_query($conn, "SELECT * FROM `totalorder` where order_status = 1 ");


?>
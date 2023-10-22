<?php

require("config.php");

$sql = "DELETE FROM totalorder WHERE id = ".$_POST['orderID'];

if (mysqli_query($conn,$sql)){
    echo "Delete Successful";
    }
    else{
        echo "Error: " .$sql ."<br>" .mysqli_error($conn);
    }
    mysqli_close($conn);

    header('Location: http://localhost/ThaiTanic/view_orders_page.php');
exit();
?>
?>
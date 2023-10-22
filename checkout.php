<?php

@include 'config.php';


//SUBMITTING THE ORDER
if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $street = $_POST['street'];
  
  

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
         


      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `neworder`(name, email, method, street, total_products, total_price) VALUES('$name','$email','$method', '$street', '$total_product','$price_total')") or die('query failed');
   $detail2_query = mysqli_query($conn, "INSERT INTO `totalorder`(name, email, method, street, total_product, total_price) VALUES('$name','$email','$method', '$street', '$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>your order: </h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
              <span class='total'> total : $".$price_total."/-  </span>
             
            
         </div>
         <div class='customer-details'>
            <p> Name : <span>".$name."</span> </p>
            
           
            <p> Table : <span>".$street." </span> </p>
            <p> Payment mode : <span>".$method."</span> </p>
            
         </div>
            <a href='products.php' class='btn'>next order</a>
         </div>
      </div>
      ";
   }

}

 
//LOYALTY POINTS
if(isset($_POST['order_btn'])){

   $email = $_POST['email'];
  
   $cart_query = mysqli_query($conn, "SELECT * FROM `neworder` WHERE email='$email'");
   
   $loyalty_total = 0;
   $rate = 0.01;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name = $product_item['email'];
         $product_price = number_format($product_item['total_price'] * $rate);
         $loyalty_total = $loyalty_total + $product_price;
      };
   };

  
   $detail_query = mysqli_query($conn, "INSERT INTO `loyalty`(email, points, grand_total) VALUES('$product_name','$product_price', '$loyalty_total') ON DUPLICATE KEY UPDATE email = '$product_name', points = '$product_price', grand_total = '$loyalty_total'") or die('query failed');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="icon" type="image/x-icon" href="pic.jpg">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <style>
      <?php include '.\css\style.css'; ?>
   </style>

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
<body bgcolor=#252837>
<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
        
         $redeem_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($redeem_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($redeem_cart)){
            $new_total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $new_total_price;
         
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
            
         }
      }
      else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <?php 
        
         if(isset($_POST['rdmloyalty_btn'])){
         
         $email = $_POST['email'];
         $redeem_query = mysqli_query($conn, "SELECT * FROM `loyalty` WHERE email='$email'");
         if(mysqli_num_rows($redeem_query) > 0){
            while($product_item = mysqli_fetch_assoc($redeem_query)){
               
               $max_loyalty = $product_item['grand_total'];
               $reduced_price = number_format($grand_total - $max_loyalty);
               $curr_email = $product_item['email'];
               
               }
             
            };
   

   $name = $_POST['name'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $street = $_POST['street'];
  
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
         


      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `neworder`(name, email, method, street, total_products, total_price) VALUES('$name','$email','$method', '$street', '$total_product','$reduced_price')") or die('query failed');
   $detail2_query = mysqli_query($conn, "INSERT INTO `totalorder`(name, email, method, street, total_product, total_price) VALUES('$name','$email','$method', '$street', '$total_product','$reduced_price')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>your order: </h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
              <span class='total'> total : $".$reduced_price."/-  </span>
             
            
         </div>
         <div class='customer-details'>
            <p> Name : <span>".$name."</span> </p>
            
           
            <p> Table : <span>".$street." </span> </p>
            <p> Payment mode : <span>".$method."</span> </p>
            
         </div>
            <a href='products.php' class='btn'>next order</a>
         </div>
      </div>
      
      
      ";
     $delete_query = mysqli_query($conn, "DELETE FROM `neworder` WHERE email = '$email'");
   }


};

      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>


      <?php if(isset($_POST['rdmloyalty_btn'])){ ?> 
     <span class="grand-total"> reduced total : $<?= $reduced_price; ?>/- </span>
      <?php 
      
      $detail_query = mysqli_query($conn, "INSERT INTO `loyalty`(email, points, grand_total) VALUES('$curr_email','0', '0') ON DUPLICATE KEY UPDATE email = '$curr_email', points = '0', grand_total = '0'") or die('query failed');} ?> 

            

   </div>

      <div class="flex">
         <div class="inputBox">
            <span>server name</span>
            <input type="text" placeholder="enter your name" name="name" required>
           
            <input type="submit" value="Redeem Loyalty Points" name="rdmloyalty_btn" class="btn">
       
         </div>
        
         <div class="inputBox">
            <span>customer email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on devlivery</option>
               <option value="credit cart">credit cart</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
        
         <div class="inputBox">
           
            <span>Table</span>
            <select name="street">
               <option value="Table 1" selected>Table 1</option>
               <option value="Table 2">Table 2</option>
               <option value="Table 3">Table 3</option>
               <option value="Table 4">Table 4</option>
               <option value="Table 5">Table 5</option>
               <option value="Table 6">Table 6</option>
            </select>
         </div>
         
        
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   

</body>
</html>
<div class="display-order">
      <?php
        
         $redeem_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($redeem_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($redeem_cart)){
            $new_total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $new_total_price;
         

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
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
            
         }
      }
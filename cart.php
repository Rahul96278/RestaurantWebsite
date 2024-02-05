<!--------------------------------database connection--------------------------------------------->

<?php

include 'db_connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};


//-----------------------------------------------------------add to cart button php----------------------------------
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};


//-----------------------------------------------------------update cart button php----------------------------------

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
     echo '
      <script>
       alert("cart quantity updated successfully!")
    
       </script>
        '
                    ;
     
}


//-----------------------------------------------------------remove button php----------------------------------

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];

    
    if($conn) {
        
        $remove_id = mysqli_real_escape_string($conn, $remove_id);
        
   
        $query = "DELETE FROM `cart` WHERE id = '$remove_id'";
        $result = mysqli_query($conn, $query);
        
        if($result) {
            echo '<script>alert("Item removed successfully!");</script>';
        } else {
            echo '<script>alert("Failed to remove item.");</script>';
        }
    } else {
        echo '<script>alert("Database connection error.");</script>';
    }
}



//-----------------------------------------------------------remove all button php----------------------------------
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   
      echo '
      <script>
       alert("all items removed successfully!")
    
       </script>
        '
                    ;
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>my cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
 <!--header-->
   
<header class="header">

   <section class="flex">

      <a href="home.html" class="logo">Signature cuisine</a>

      <nav class="navbar">
         <a href="home.html">Home</a>
         <a href="about.html">About</a>
         <a href="menu.php">Menu</a>
         <a href="orders.php">Orders</a>
         <a href="contact.html">Contact</a>
		   <a href="reservation.php">Reservation</a>
		 <a href="feedback.php">Feedback</a>
      </nav>

      <div class="icons">
         <a href="search.html"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <p class="name"></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="#" class="delete-btn">logout</a>
         </div>
         <p class="account"><a href="login.php">login</a> or <a href="register.php">register</a></p>
      </div>

   </section>

</header>

<div class="heading">
   <h3>shopping cart table</h3>
   <p><a href="home.html">home </a> <span> / cart</span></p>
</div>

<section class="products">

   <h1 class="title">your cart</h1>

  
    <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
          
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
   
	
<div class="box-container">

	   
	   
      <div class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
          <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('remove item from cart?');"></a> 
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
         <div class="name"> <?php echo $fetch_cart['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?php echo $fetch_cart['price']; ?></div>
			   <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" name="cart_quantity" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" value="<?php echo $fetch_cart['quantity']; ?>">
            <button type="submit" name="update_cart" class="fas fa-edit"></button>
         </div>
         <div class="sub-total">sub total : <span>$3</span><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></div>
      </div>

      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo 'no item added';
         }
      ?>
            
    <div class="cart-total">
      <p>grand total : <span>$</span><?php echo $grand_total; ?></p>
      <a href="checkout.php" class="btn">checkout orders</a>
      </div>
   </div> 

   <div class="more-btn">
     <a href="cart.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a>

         
   </div>
</section>

<footer class="footer">

   <section class="box-container">

      <div class="box">
         <img src="images/email-icon.png" alt="">
         <h3>our email</h3>
         <a href="mailto:shaikhanas@gmail.com">rahul@gmail.com</a>
         <a href="mailto:anasbhai@gmail.com">viraa@gmail.com</a>
      </div>

      <div class="box">
         <img src="images/clock-icon.png" alt="">
         <h3>opening hours</h3>
         <p>00:07am to 00:10pm </p>
      </div>

      <div class="box">
         <img src="images/map-icon.png" alt="">
         <h3>our address</h3>
         <a href="https://www.google.com/maps">colombo, sri lanka </a>
      </div>

      <div class="box">
         <img src="images/phone-icon.png" alt="">
         <h3>our number</h3>
         <a href="tel:1234567890">011 252 3458</a>
         <a href="tel:1112223333">076 357 1997</a>
      </div>

   </section>

  

</footer>





<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>
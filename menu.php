<!------------------------------------------------------database connection-------------------------------------------------->
<?php
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
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


//--------------------------------------------------------------add to cart php--------------------------------------
if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      echo '
      <script>
       alert("Products already added ..")
       </script>
        ';
         
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
         echo '
      <script>
       alert("Products added successfully..")
       </script>
        ';
   }

};




?>









<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>food menu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   

   
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
   <h3>our menu</h3>
   <p><a href="home.html">home </a> <span> / menu</span></p>
</div>

<section class="products">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>											 
	     <img src="uploaded_img/p1.png" alt="" >
         <a href="category.html" class="cat">fast food</a>
         <div class="name">delicious pizza 01</div>
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
			
			 <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p1.png">
         <input type="hidden" name="product_name" value="pizza">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
            
         </div>
      </form>

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/p2.png" alt="">
         <a href="category.html" class="cat">dishes</a>
         <div class="name">main dish 01</div>
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
             <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p2.png">
         <input type="hidden" name="product_name" value="main">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         </div>
      </form>

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/p3.png" alt="">
         <a href="category.html" class="cat">fast food</a>
         <div class="name">chezzy hamburger 01</div>
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
             <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p3.png">
         <input type="hidden" name="product_name" value="chezzy">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         </div>
      </form>

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/p4.png" alt="">
         <a href="category.html" class="cat">dessert</a>
         <div class="name">delicious dessert 01</div>
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
           <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p4.png">
         <input type="hidden" name="product_name" value="dessert">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         </div>
      </form>

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/p5.png" alt="">
         <a href="category.html" class="cat">drinks</a>
         <div class="name">fresh drink 01</div>
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
          <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p5.png">
         <input type="hidden" name="product_name" value="drink">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         </div>
      </form>

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/p6.png" alt="">
         <a href="category.html" class="cat">dishes</a>
         <div class="name">main dish 02</div>
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
            <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p6.png">
         <input type="hidden" name="product_name" value="dish">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         </div>
      </form>

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/p7.png" alt="">
         <a href="category.html" class="cat">fast food</a>
         <div class="name">chezzy hamburger 02</div>
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
            <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p7.png">
         <input type="hidden" name="product_name" value="chezzy2">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         </div>
      </form>

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/p8.png" alt="">
         <a href="category.html" class="cat">fast food</a>
         <div class="name">delicious pizza 02</div>
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
           <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p8.png">
         <input type="hidden" name="product_name" value="pizza2">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         </div>
      </form>

      <form accept="" method="post" class="box">
         <a href="quick_view.html" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="uploaded_img/p9.png" alt="">
         <a href="category.html" class="cat">dessert</a>
         <div class="name">delicious dessert 02</div  >
         <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
           <input type="hidden" name="product_price" value="3">
         <input type="hidden" name="product_image" value="p9.png">
         <input type="hidden" name="product_name" value="dessert2">
		  <input type="number" min="1" name="product_quantity" class="quan"  value="1">
         </div>
      </form>

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
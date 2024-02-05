<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header('location: login.php');
}

if (isset($_GET['logout'])) {
   session_unset();
   session_destroy();
   header('location: login.php');
}

if (isset($_POST['add_to_cart'])) {
   // Code for adding items to the cart
   // ...

   // Redirect or show a message after adding to the cart
   header('location: checkout.php');
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$user_query = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$user_id'");
if ($user_query && mysqli_num_rows($user_query) > 0) {
   $user_data = mysqli_fetch_assoc($user_query);
}

// Fetch cart details
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
$grand_total = 0;

?>


  <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

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
</head>
<body>
  

   <div class="heading">
      <h3>Checkout</h3>
      <p><a href="home.html">Home</a> <span> / Checkout</span></p>
   </div>

   <section class="checkout">
	 
   <h1 class="title">order summary</h1>
   <form action="" method="post">
      <div class="user-info">
      <!-- Display user details -->
      
      <p>Name: <?php echo $user_data['name']; ?></p>
      <p>Email: <?php echo $user_data['email']; ?></p>
      <!-- Add more user details as needed -->

    <div class="user-info">
         <h3>cart items</h3>
     
         <?php
         if (mysqli_num_rows($cart_query) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
               // Display cart items
               echo '<div class="box-container">';
               echo '<div class="box">';
            
               echo '<div class="name">' . $fetch_cart['name'] . '</div>';
               echo '<div class="flex">';
               echo '<div class="price"><span>$</span>' . $fetch_cart['price'] . '</div>';
               echo '<input type="hidden" name="cart_id" value="' . $fetch_cart['id'] . '">';
               echo '<input type="number" name="cart_quantity" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" value="' . $fetch_cart['quantity'] . '">';
               echo '</div>';
               echo '</div>';

               $grand_total += $fetch_cart['price'];
               echo '</div>';
            }
         } else {
            echo 'No items in the cart.';
         }
         ?>
         <div class="cart-total">
            <p>Grand Total: <span>$</span><?php echo $grand_total; ?></p>
         </div>
         <!-- Add form elements for delivery address and payment method -->
         <input type="submit" value="Place Order" name="order" class="btn order-btn">
      </form>
   </section>

   <!-- Footer content here -->
</body>
</html>

<?php
mysqli_close($conn);
?>

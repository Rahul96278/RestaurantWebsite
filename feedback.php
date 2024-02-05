  <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Feedback</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
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
	
<?php
include 'db_connection.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    // Check if the email and name combination already exists
    $check_query = "SELECT * FROM `feedback` WHERE email = '$email' AND name = '$name'";
    $check_result = mysqli_query($conn, $check_query) or die('Check query failed');

    if (mysqli_num_rows($check_result) > 0) {
        echo 'Feedback already exists for this name and email.';
    } else {
        // Insert new feedback into the database
        $insert_query = "INSERT INTO `feedback` (name, email, feedback) VALUES ('$name', '$email', '$feedback')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            echo '
            <script>
                alert("Feedback sent successfully.");
            </script>';
        } else {
            echo 'Failed to insert feedback into the database: ' . mysqli_error($conn);
        }
    }
}



?>




<section class="form-container">
   <form action="feedback.php" method="post">
     <div class="profile">
       
         

      <input type="text" required maxlength="20" name="name" placeholder="Enter your name" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="email" required maxlength="50" name="email" placeholder="Enter your email" class="box" oninput="this.value = this.value replace(/\s/g, '')">
      <input type="text" required maxlength="20" name="feedback" placeholder="Enter your feedback" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
     
      <input type="submit" value="Submit feedback" class="btn" name="submit">
     
   </form>
</section>

<footer class="footer">
   <section class="box-container">
      <div class="box">
         <img src="email-icon.png" alt="">
         <h3>Our Email</h3>
         <a href="mailto:shaikhanas@gmail.com">rahul@gmail.com</a>
         <a href="mailto:anasbhai@gmail.com">viraa@gmail.com</a>
      </div>
      <div class="box">
         <img src="clock-icon.png" alt="">
         <h3>Opening Hours</h3>
         <p>00:07am to 00:10pm</p>
      </div>
      <div class="box">
         <img src="map-icon.png" alt="">
         <h3>Our Address</h3>
         <a href="https://www.google.com/maps">colombo, sri lanka</a>
      </div>
      <div class="box">
         <img src="phone-icon.png" alt="">
         <h3>Our Number</h3>
         <a href="tel:1234567890">011 252 3458</a>
         <a href="tel:1112223333">076 357 1997</a>
      </div>
   </section>
</footer>

<div class="loader">
   <img src="loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>


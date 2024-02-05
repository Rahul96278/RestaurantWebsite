<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

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

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST['cpass']);

    if ($pass !== $confirm_pass) {
        echo '<script>alert("Passwords do not match. Please try again.")</script>';
    } else {
        $query = "SELECT * FROM `user` WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0) {
            echo '<script>alert("User already registered.")</script>';
        } else {
            $insert_query = "INSERT INTO `user` (name, mobile, email, password) VALUES ('$name', '$mobile', '$email', '$pass')";
            if (mysqli_query($conn, $insert_query)) {
                echo '<script>alert("Registered successfully.")</script>';
                header("Location: login.php");
            } else {
                echo '<script>alert("Registration failed. Please try again.")</script>';
            }
        }
    }
}
?>

<section class="form-container">
   <form action="register.php" method="post">
     <div class="profile">
       
         <div class="flex">
            <a href="admin_register.php" class="btn">Admin</a>
            <a href="staff_register.php" class="btn">Staff</a>
			 <a href="register.php" class="btn">User</a>
         </div>

      <input type="text" required maxlength="20" name="name" placeholder="Enter your name" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="email" required maxlength="50" name="email" placeholder="Enter your email" class="box" oninput="this.value = this.value replace(/\s/g, '')">
      <input type="number" placeholder="Enter your number" required class="box" name="mobile">
      <input type="password" required maxlength="20" id="password" name="password" placeholder="Enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" required maxlength="20" id="confirm_password" name="cpass" placeholder="Confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Register Now" class="btn" name="submit">
      <p>Already have an account? <a href="login.php">Login now</a></p>
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

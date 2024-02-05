<?php
include 'db_connection.php';
session_start();

if (isset($_POST['submit'])) {
    // Sanitize and validate user input before using it in a query
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE name = '$name' AND email = '$email'") or die('Query failed');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
    }
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($result);
}


if (isset($_POST['edit'])) {
    // Sanitize and validate user input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    $sql = "UPDATE `user` SET `name` = '$name', `email` = '$email', `mobile` = '$mobile' WHERE `id` = $user_id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Update failed: ' . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

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

<section class="form-container">

   <form action="" method="POST">
      <h3>update profile</h3>
      <input type="text" required maxlength="20" name="name" placeholder="enter your name" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?php if(isset($fetch)){ echo $fetch['name']; } ?>">
      <input type="email" required maxlength="50" name="email" placeholder="enter your email" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?php if(isset($fetch)){ echo $fetch['email']; } ?>">
      <input type="text" placeholder="enter your number" required class="box" name="mobile" value="<?php if(isset($fetch)){ echo $fetch['mobile']; } ?>">
      
      <input type="submit" value="update now" class="btn" name="edit">
   </form>

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
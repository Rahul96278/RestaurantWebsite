<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reservation Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="main.css">
	


</head>
<body>

<section class="banner">
    <h2>BOOK YOUR TABLE NOW</h2>
    <div class="card-container">
        <div class="card-img">
            <!-- image here -->
        </div>

        <div class="card-content">
            <h3>Reservation</h3>
            <?php
            include 'db_connection.php';

            if(isset($_POST['submit'])){
                $days = mysqli_real_escape_string($conn, $_POST['days']);
                $hours = mysqli_real_escape_string($conn, $_POST['hours']);
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
                $count = mysqli_real_escape_string($conn, $_POST['count']);

                // Check if the email and name combination already exists
                $check_query = "SELECT * FROM `reserve` WHERE name = '$name' AND mobile = '$mobile'";
                $check_result = mysqli_query($conn, $check_query) or die('Check query failed');

                if (mysqli_num_rows($check_result) > 0) {
                    echo 'Already reserved for this name and mobile.';
                } else {
                    // Insert into the database
                    $insert_query = "INSERT INTO `reserve` (days, hours, name, mobile, count) VALUES ('$days', '$hours', '$name', '$mobile', '$count')";
                    $insert_result = mysqli_query($conn, $insert_query);

                    if ($insert_result) {
                        echo '
                        <script>
                            alert("Reserved successfully.");
							
                        </script>';
						
                    }   else {
                        echo 'Failed to reserve ' . mysqli_error($conn);
                    }
                }
            }
            ?>
            <form method="POST">
                <div class="form-row">
                    <select name="days">
                        <option value="day-select">Select Day</option>
                        <option value="sunday">Sunday</option>
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                    </select>
                    <select name="hours">
                        <option value="hour-select">Select Hour</option>
                        <option value="10:00">10:00</option>
                        <option value="12:00">12:00</option>
                        <option value="14:00">14:00</option>
                        <option value="16:00">16:00</option>
                        <option value="18:00">18:00</option>
                        <option value="20:00">20:00</option>
                        <option value="22:00">22:00</option>
                    </select>
                </div>
                <div class="form-row">
                    <input type="text" placeholder="Full Name" name="name">
                    <input type="text" placeholder="Phone Number" name="mobile">
                </div>
                <div class="form-row">
                    <input type="number" placeholder="How Many Persons?" min="1" name="count">
                    <input type="submit" value="BOOK TABLE" name="submit">
                </div>
            </form>
        </div>
    </div>
</section>

</body>
</html>

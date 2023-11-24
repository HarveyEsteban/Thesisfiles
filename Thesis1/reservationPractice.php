<?php
      include_once("connection/connection.php");
      $con = connection();

      session_start();
      $user = $_SESSION['UserLogin'];
      $userID = $_SESSION['UserID'];



      //INSERT INTO `reservation` (`reservationID`, `userID`, `service`, `start_date`, `end_date`, `status`) VALUES ('1', '1', 'Cleaning', '2023-05-14 21:52:19.000000', '2023-05-14 21:52:19.000000', 'Pending');

    if(isset($_POST['Reserve'])){
        

        $services = $_POST['services'];
        $start_date = $_POST['Start_date'];
        $end_date = $_POST['End_date'];


        $query = "INSERT INTO `reservation`(`start_date`, `end_date`, `service`, `userID`,`status`) VALUES ('$start_date','$end_date','$services', '$userID','Pending')";
        $run_query = mysqli_query($con, $query);


    }

    if(isset($_POST['Logout'])){    
        unset($_SESSION['UserLogin']);
        unset($_SESSION['UserID']);

        echo header("Location: Dental-landingPage.php");
    }


    if(isset($_POST['Calendar'])){
        echo header("Location: calendar.php");
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Practice</title>
</head>
<body>
    
<form action="" method = "POST">
    <?php
        echo "<h2>$user</h2>";
    ?>
    <br>

    <label> Start Date</label>
    <input type="datetime-local" name = "Start_date" />

    <br>

    <label >End Date</label>
    <input type="datetime-local" name = "End_date" />

    <br>

    <label>Services</label>
    <select name="services">
    <option value="">---Select Services---</option>
        <option value="Cleaning">Cleaning</option>
        <option value="Braces">Braces</option>
        <option value="Pasta">Pasta</option>
        <option value="ToothExtraction">Tooth Extraction</option>
        <option value="Consultation">Consultation</option>
        <option value="Dentures">Dentures</option>
        <option value="Scaling and Root Planning">Scaling and Root Planning</option>
    </select>

    <br>

    <button type = "submit" name = "Reserve">Reserve Now</button>
    <br>
    <button type="submit" name ="Logout">Logout</button>
    <br>
    <button type="submit" name ="Calendar">Calendar</button>

</form>

</body>
</html>
<?php
    require_once 'phpqrcode/qrlib.php';
    include_once("connection/connection.php");
    $con = connection();


    if(isset($_GET['qrID'])){
        $qrID = $_GET['qrID'];

        $sqlQrstmt = "SELECT bookinglog.resID, bookinglog.serviceName, bookinglog.date,bookinglog.timeslot, patients_user.Name,patients_user.PhoneNumber
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID where status = 'Pending' AND resID = $qrID";
        $exe = $con->query($sqlQrstmt);
    
        $row = $exe->fetch_assoc();

        if($row){
            $ResID = $row['resID'];
            $serviceName = $row['serviceName'];
            $date = $row['date'];
            $timeslot = $row['timeslot'];
            $name = $row['Name'];
            $phoneNum = $row['PhoneNumber'];

            $path = 'images/';
            // Filename
            $file = $path.date("Y-m-d-h-i-s").'.png';

            // Our text: here we will use concat
            $text = "Reservation ID: ". $ResID . "\n";
            $text .= "Patients Name: ". $name. "\n";
            $text .= "Service Name: ". $serviceName. "\n";
            $text .= "Reservation Date: ". $date. "\n";
            $text .= "Reservation Timeslot: ". $timeslot. "\n";
            $text .= "Patients Phone number: ". $phoneNum;

            // Lets create
            QRcode::png($text, $file, 'H', 2, 2);

          
           
        }
        


    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Centered Div</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* 100% of the viewport height */
      margin: 0;
     background-image: url(assets/img/Picsart_23-04-17_12-49-06-946.png);
     background-repeat: no-repeat; 
     background-size: fit;
     background-position: center center; /* Center the background image */

    }

    .centered-div {
      text-align: center;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: #f8f9fa;
    }

    
  </style>
</head>
<body>
  <div class="centered-div">
    <div class="form-group" style="background-color: rgb(187,177,114);">
        <h1>Qr Code</h1>
    </div>
    <?php 
      // Lets echo the image
     echo '<img name="qrCode" class="img-fluid" src="'.$file.'" width="450" height="400">';
    ?>

    <div class="form-group">
    <button type="button" onclick="window.location.href='patientsOwnReservation.php'" class="btn btn-lg btn-block" style="background-color:rgb(187,177,114) ;">Go back</button>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

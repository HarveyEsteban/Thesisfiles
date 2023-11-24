<?php
      include_once("connection/connection.php");
      $con = connection();

      session_start();
      $user = $_SESSION['UserLogin'];
      $userID = $_SESSION['UserID'];



      //INSERT INTO `reservation` (`reservationID`, `userID`, `service`, `start_date`, `end_date`, `status`) VALUES ('1', '1', 'Cleaning', '2023-05-14 21:52:19.000000', '2023-05-14 21:52:19.000000', 'Pending');

    if(isset($_POST['reserve'])){
        

        $services = $_POST['services'];
        $start_date = $_POST['Start_date'];
        $end_date = $_POST['End_date'];


        $query = "INSERT INTO `reservation`(`start_date`, `end_date`, `service`, `userID`,`status`) VALUES ('$start_date','$end_date','$services', '$userID','Pending')";
        $run_query = mysqli_query($con, $query);


    }

    if(isset($_POST['Calendar'])){
        echo header("Location: index.php");
    }




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="generator" content="HTML Tidy for Windows (vers 14 October 2008), see www.w3.org" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <title>DENTALPODADMIN-1</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Advent+Pro&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Albert+Sans&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alike+Angular&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alumni+Sans&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anek+Odia&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Days+One&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i&amp;display=swap" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i" type="text/css" />
        <link rel="stylesheet" href="assets/css/aguilaraldo1_section_contact.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Basic-Footer.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Black-Navbar.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Block-Responsive-Item-List.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Bootstrap-Calendar.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/carousel-circulo.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Carousel-Hero-1.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Carousel-Hero.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Diagonal-div-section.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Feature-Section-MD.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/Ultimate-Event-Calendar.css" type="text/css" />
        <style type="text/css">
 button.c1 {margin: 10px;}
</style>
    </head>
    <body>
        <form method="post">
        <input type="date" />
        <input type="date" />
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">Dropdown</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">First Item</a>
                <a class="dropdown-item" href="#">Second Item</a>
                <a class="dropdown-item" href="#">Third Item</a>
            </div>
        </div>
        <button class="btn btn-primary c1" type="button" name="reserve">Reserve</button> 
        <button class="btn btn-primary c1" type="button" name="calendar">Calendar</button></form>

        
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/bs-init.js" type="text/javascript"></script>
        <script src="assets/js/theme.js" type="text/javascript"></script>
        <script src="assets/js/Ultimate-Event-Calendar.js" type="text/javascript"></script>
    </body>
</html>
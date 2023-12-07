<?php
    include_once("connection/connection.php");
    $con = connection();
    
    function build_calendar($month, $year) {
        $mysqli = new mysqli('localhost', 'root', 'Thesis1', 'patientsdb');
        // $stmt = $mysqli->prepare("SELECT * FROM bookrecords WHERE MONTH(date) = ? AND YEAR(date) = ?");
        // $stmt->bind_param('ss', $month, $year);
        // $bookings = array();
        // if($stmt->execute()){
        //     $result = $stmt->get_result();
        //     if($result->num_rows>0){
        //         while($row = $result->fetch_assoc()){
        //             $bookings[] = $row['date'];
        //         }
                
        //         $stmt->close();
        //     }
        // }
        
        
        
         $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
         $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
         $numberDays = date('t',$firstDayOfMonth);
         $dateComponents = getdate($firstDayOfMonth);
         $monthName = $dateComponents['month'];
         $dayOfWeek = $dateComponents['wday'];
         $tomorrow = date('Y-m-d', strtotime('+3 day')); // this is the code to disable the date of today

    
        $datetoday = date('Y-m-d');
       
        $calendar = "<table class='table table-bordered'>";
        $calendar .= "<center><h2>$monthName $year</h2>";
        $calendar.= "<a class='btn btn-xs btn-success' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
        $calendar.= " <a class='btn btn-xs btn-danger' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
        $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
        
       
          $calendar .= "<tr>";
         foreach($daysOfWeek as $day) {
              $calendar .= "<th  class='header'>$day</th>";
         } 
    
         $currentDay = 1;
         $calendar .= "</tr><tr>";
    
    
         if ($dayOfWeek > 0) { 
             for($k=0;$k<$dayOfWeek;$k++){
                    $calendar .= "<td  class='empty'></td>"; 
    
             }
         }
        
         $month = str_pad($month, 2, "0", STR_PAD_LEFT);
      
         while ($currentDay <= $numberDays) {
    
              if ($dayOfWeek == 7) {
    
                   $dayOfWeek = 0;
                   $calendar .= "</tr><tr>";
    
              }
              
              $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
              $date = "$year-$month-$currentDayRel";
              
                $dayname = strtolower(date('l', strtotime($date)));
                $eventNum = 0;
                $today = $date==date('Y-m-d')? "today" : "";

            if ($date<$tomorrow) { // Change the  date('Y-m-d') to $tomorrow to only allow use to book for tom schedule and not on the same day
                $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-lg' disabled>&nbsp</button>";
             }
             else{
    
                $totalBookings =checkSlots($mysqli,$date);
                if($totalBookings == 16){
                    $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='#' disabled class='btn btn-danger btn-lg'>No Slots</a>";
    
                }else{
                    $avaislots = 16 - $totalBookings;
                    $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='register.php' class='btn btn-success btn-l'> <span class='glyphicon glyphicon-ok'></span>Reserve Now</a><small><i>$avaislots slots</i></small>";
    
                }
             }
                
              $calendar .="</td>";
              $currentDay++;
              $dayOfWeek++;
         }
    
         if ($dayOfWeek != 7) { 
         
              $remainingDays = 7 - $dayOfWeek;
                for($l=0;$l<$remainingDays;$l++){
                    $calendar .= "<td class='empty'></td>"; 
             }
         }
         
         $calendar .= "</tr>";
         $calendar .= "</table>";
         echo $calendar;
    
    }
    
    
    function checkSlots($mysqli, $date){
            $stmt = $mysqli->prepare("SELECT * FROM bookinglog WHERE date = ?");
                $stmt->bind_param('s',$date);
                $totalBookings = 0;
                if($stmt->execute()){
                    $result = $stmt->get_result();
                    if($result->num_rows>0){
                        while($row = $result->fetch_assoc()){
                           $totalBookings++;
                        }
                        
                        $stmt->close();
                    }
                    return $totalBookings;
                }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>DENTALPODADMIN-1-1</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Advent+Pro&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Albert+Sans&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alike+Angular&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alumni+Sans&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anek+Odia&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Days+One&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/aguilaraldo1_section_contact.css">
    <link rel="stylesheet" href="assets/css/Availability---Manage-availability-bookings-appointments_v1.css">
    <link rel="stylesheet" href="assets/css/Basic-Footer.css">
    <link rel="stylesheet" href="assets/css/Black-Navbar.css">
    <link rel="stylesheet" href="assets/css/Block-Responsive-Item-List.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Calendar.css">
    
    <link rel="stylesheet" href="assets/css/carousel-circulo.css">
    <link rel="stylesheet" href="assets/css/Carousel-Hero-1.css">
    <link rel="stylesheet" href="assets/css/Carousel-Hero.css">
    <link rel="stylesheet" href="assets/css/Diagonal-div-section.css">
    <link rel="stylesheet" href="assets/css/Feature-Section-MD.css">
    <link rel="stylesheet" href="https://djpsoftwarecdn.azureedge.net/availabilitycss-v1/availability.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Event-Calendar.css">
    <style>
       @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;

            }
            
            

            .empty {
                display: none;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }



            /*
		Label the data
		*/
            td:nth-of-type(1):before {
                content: "Sunday";
            }
            td:nth-of-type(2):before {
                content: "Monday";
            }
            td:nth-of-type(3):before {
                content: "Tuesday";
            }
            td:nth-of-type(4):before {
                content: "Wednesday";
            }
            td:nth-of-type(5):before {
                content: "Thursday";
            }
            td:nth-of-type(6):before {
                content: "Friday";
            }
            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }

        /* Smartphones (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        /* iPads (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }
            td {
                width: 33%;
            }
        }
        
        .row{
            margin-top: 20px;
        }
        
        .today{
            background:#eee;
        }

    </style>
</head>

<body style="color: var(--bs-blue);background: rgb(255,255,255);border-top-left-radius: 11px;">
    <div class="col">
        <nav class="navbar navbar-light navbar-expand-md py-3" style="background: #ffffff;height: 100px;border-top: 4px solid rgb(159,152,117);border-bottom-color: rgb(159,152,117);">
            <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><img src="assets/img/Picsart_23-04-17_12-49-06-946.png" width="83" height="83"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier">
                            <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
                            <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
                        </svg></span><span style="padding-left: 28px;font-family: Nunito, sans-serif;font-size: 27px;color: rgb(0,0,0);text-decoration: underline;">THE DENTAL POD</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-2" style="background: #ffffff;border-radius: 13px;width: 2px;padding-left: 0px;margin-left: 259px;padding-bottom: 15px;padding-right: 0px;margin-right: -18px;">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"></li>
                        <li class="nav-item"><a class="nav-link active" href="Landingpage.php" style="border-width: 0px;margin-left: 15px;"><strong>Home</strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="ServicesLandingpage.php" style="border-width: 0px;margin-left: 15px;font-weight: bold;">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="About.html" style="border-width: 0px;margin-left: 15px;font-weight: bold;">About</a></li>
                        <li class="nav-item"></li>
                    </ul><a class="btn btn-primary ms-md-2" role="button" href="register.php" style="background: rgb(159,152,117);border-color: rgb(159,152,117);border-top-color: rgb(159,152,117);border-radius: 5px;margin-right: 6px;margin-left: 14px;">Sign Up</a><a class="btn btn-primary ms-md-2" role="button" href="loginpage.php" style="background: rgb(159,152,117);border-color: rgb(159,152,117);border-top-color: rgb(159,152,117);border-radius: 5px;">Login</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="col">
        <div class="carousel slide" data-bs-ride="carousel" id="carousel-1">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="bg-light border rounded border-light hero-nature carousel-hero jumbotron py-5 px-4" style="height: 510px;text-align: center;">
                        <h1 class="hero-title" style="color: #000000;font-family: Roboto, sans-serif;font-size: 70px;margin-top: 69px;">Dental Pod</h1>
                        <p class="hero-subtitle" style="color: #2b2b2b;background: Transparent;font-family: Roboto, sans-serif;border-radius: 21px;text-align: center;font-size: 23px;">Welcome To The Dental Pod Your Trusted Destination For Comprehensive Dental Care! We Are Delighted To Have You here And Thank You For Visiting Our Website.</p>
                       
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="bg-light border rounded border-light hero-photography carousel-hero jumbotron py-5 px-4" style="height: 510px;">
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="bg-light border rounded border-light hero-technology carousel-hero jumbotron py-5 px-4" style="height: 510px;"></div>
                </div>
            </div>
            <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
            <ol class="carousel-indicators">
                <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
            </ol>
        </div>
    </div>
    <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" style="background:#9f9875;border:none;color:#fff">
                        <h1>Calendar</h1>
                        </div>
                        <?php
                            $dateComponents = getdate();
                            if(isset($_GET['month']) && isset($_GET['year'])){
                                $month = $_GET['month'];
                                $year = $_GET['year'];
                            }else{
                                $month = $dateComponents['mon'];
                                $year = $dateComponents['year'];
                            }
                            echo build_calendar($month, $year);
                        ?>
                </div>
            </div>
    <div class="col">
        <div class="container">
            <div class="row row-fitur">
                <div class="col-sm-4 col-md-4 waves-effect kolom-a">
                    <div class="fitur-a"><img src="assets/img/app%20(1).png" width="208" height="197"></div>
                    <div class="separator-fitur" style="background: rgb(208,206,149);"></div>
                    <div>
                        <h4 class="heading-fitur" style="color: rgb(0,0,0);">Easy to Reserve a Dental Treatment</h4>
                        <p class="paragraf-fitur">To make an reservation online, and to provide clear instructions for what to expect before, during, and after their appointment.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 waves-effect kolom-b">
                    <div class="fitur-a"><img src="assets/img/dental%20(1).png" width="208" height="197" style="width: 208px;height: 197px;"></div>
                    <div class="separator-fitur" style="background: rgb(208,206,149);height: 1px;"></div>
                    <div>
                        <h4 class="heading-fitur" style="color: rgb(0,0,0);">Provides Clear Information About Dental Services</h4>
                        <p class="paragraf-fitur">It provides clear information of dental services offered by the clinic including descriptions, pricing, and availability.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 waves-effect kolom-c">
                    <div class="fitur-a"><img src="assets/img/landing-page.png" style="height: 198px;"></div>
                    <div style="background: rgb(208,206,149);color: rgb(208,206,149);" class="separator-fitur"></div>
                    <div>
                        <h4 class="heading-fitur" style="color: rgb(0,0,0);">Online Patient Portal</h4>
                        <p class="paragraf-fitur">Patients can view their treatment history, and schedule appointments.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col"></div>
    <div class="col">
        <footer id="footerpad" style="background: rgb(159,152,117);">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-8 mx-auto"></div>
                    <div class="col">
                        <ul class="list-inline text-center" style="margin-left: 167px;">
            <li class="list-inline-item"><a id="social-footer-icon-facebook" href="https://www.facebook.com/TheDentalPod"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div></div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://djpsoftwarecdn.azureedge.net/availabilityjs-v1/availability.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
</body>

</html>
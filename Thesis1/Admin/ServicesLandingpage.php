<?php
include_once("connection/connection.php");
$con = connection();



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
    <link rel="stylesheet" href="assets/css/aos.min.css">
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
                        <li class="nav-item"><a class="nav-link" href="Landingpage.php" style="font-weight: bold;">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="ServicesLandingpage.php" style="border-width: 0px;margin-left: 15px;"><strong>Services</strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="About.html" style="border-width: 0px;margin-left: 15px;"><strong>About</strong></a></li>
                        <li class="nav-item"></li>
                    </ul><a class="btn btn-primary ms-md-2" role="button" href="register.php" style="background: rgb(159,152,117);border-color: rgb(159,152,117);border-top-color: rgb(159,152,117);border-radius: 5px;margin-right: 6px;margin-left: 14px;">Sign Up</a><a class="btn btn-primary ms-md-2" role="button" href="loginpage.php" style="background: rgb(159,152,117);border-color: rgb(159,152,117);border-top-color: rgb(159,152,117);border-radius: 5px;">Login</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="col">
        <div></div>
    </div>
    <div class="col" data-aos="fade-up" data-aos-duration="800">
        <div class="row">
            <?php
                                         $getImagestmt = "SELECT * FROM `servicetbl` WHERE status = 'Un-Archive'";
                                         $exegetstmt = $con -> query($getImagestmt);
                                        
                                         if ($exegetstmt->num_rows > 0) {
                                            echo "<div class='row'>";
                                            while ($row = $exegetstmt->fetch_assoc()) {
                                                echo "<div class='col-md-6 mb-4'>";
                                                echo "<div class='card' style='width: 100%; height: 100%;'>";
                                                echo "<img class='img-fluid card-img-top' style='height: 300px; object-fit: ; border-top-left-radius: 7.6px;' src='" . $row['filename'] . "' alt='".$row['serviceName']."' width='600' height='300'>";
                                                echo "<div class='card-body'>";
                                                echo "<h5 class='card-title'><strong>" . $row['serviceName'] . "</strong></h5>";
                                                echo "<p class='card-text'>&nbsp;₱". $row['price'] . "</p>";
                                                echo "<p class='card-text'>" . $row['description'] . "</p>";
                                                echo "</div>"; // card-body
                                                echo "</div>"; // card
                                                echo "</div>"; // col-md-6
                                            }
                                            echo "</div>"; // row
                                        }
                                    ?>
        </div>
    </div>
    <div class="col">
        <footer id="footerpad" style="background: rgb(159,152,117);margin-top: 47px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-8 mx-auto"></div>
                    <div class="col">
                        <ul class="list-inline text-center" style="margin-left: 167px;">
                            <li class="list-inline-item"><a id="social-footer-icon-facebook" href="#"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
                            <li class="list-inline-item"><a id="social-footer-icon-twitter" href="#"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
                            <li class="list-inline-item"><a id="social-footer-icon-instagram" href="#"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></span></a></li>
                            <li class="list-inline-item"><a id="social-footer-icon-whatsapp" href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div></div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/aos.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://djpsoftwarecdn.azureedge.net/availabilityjs-v1/availability.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
</body>

</html>
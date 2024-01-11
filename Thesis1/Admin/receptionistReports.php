<?php
    include_once("connection/connection.php");
    $con = connection();

    session_start();
date_default_timezone_set('Asia/Manila');

    $user = $_SESSION['UserLogin'];
    $userID = $_SESSION['UserID'];

    if(isset($_GET['logout_code'])){
        session_unset();
        header("Location: Landingpage.html");
    }


//use this to show the most picked services in a week
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-BBf4y1cZCf74iifZr1eMm3z2llQjZ5C+2a+nY8v1GCpkePhhBjiid8s1pL4N2pL" crossorigin="anonymous">
      <style>

        .centered-div {
            text-align: center;
            padding: 80px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f8f9fa;
            font-size: 30px;

        }

        .centered-div>h1{
            font-size: 70px;
        }


    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="border-color: rgb(255,255,255);background: linear-gradient(#d8cfac 57%, white 100%), #a6a263;border-radius: -1px;">
            <div class="container-fluid d-flex flex-column p-0"><img src="assets/img/Picsart_23-04-17_12-49-06-946.png" width="85" height="91" style="margin-left: 0px;padding-bottom: 0px;padding-top: 10px;">
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item">
   <a class="nav-link" href="receptionistUI.php" style="background: #ffffff;border-radius: 8px;margin-top: 13px;border-color: var(--bs-blue);border-top-width: 1px;border-top-color: #95947c;border-bottom: 1px outset rgba(149,148,124,0.33);box-shadow: 0px 0px 10px rgb(159,152,117);--bs-body-bg: #fff;">
    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-people" style="color: #3e3d1a;">
      <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path>
    </svg>
    <span style="background: transparent;color: #3e3d1a;font-family: 'Albert Sans', sans-serif;font-weight: bold;">Patient's Schedule</span>
  </a>
  <a class="nav-link active" href="receptionistListofPatients.php" style="background: #ffffff;border-radius: 8px;border-color: var(--bs-blue);border-top-width: 1px;border-top-color: #95947c;border-bottom: 1px outset rgba(149,148,124,0.33);box-shadow: 0px 0px 10px rgb(159,152,117);--bs-body-bg: #fff;margin-top: 0px;">
  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-people" style="color: #3e3d1a;">
      <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path>
    </svg>
    <span style="background: transparent;color: #3e3d1a;font-family: 'Albert Sans', sans-serif;font-weight: bold;">List of Patients</span>
  </a>
  <a class="nav-link active" href="receptionistReports.php" style="background: #ffffff;border-radius: 8px;border-color: var(--bs-blue);border-top-width: 1px;border-top-color: #95947c;border-bottom: 1px outset rgba(149,148,124,0.33);box-shadow: 0px 0px 10px rgb(159,152,117);--bs-body-bg: #fff;margin-top: 0px;">
    <i class="icon ion-ios-paper-outline" style="color: #3e3d1a;"></i>
    <span style="background: transparent;color: #3e3d1a;font-family: 'Albert Sans', sans-serif;font-weight: bold;">Reports</span>
  </a>
  <a class="nav-link active" href="receptionistCalendar.php" style="background: #ffffff;border-radius: 8px;border-color: var(--bs-blue);border-top-width: 1px;border-top-color: #95947c;border-bottom: 1px outset rgba(149,148,124,0.33);box-shadow: 0px 0px 10px rgb(159,152,117);--bs-body-bg: #fff;margin-top: 0px;">
    <i class="far fa-calendar" style="color: #3e3d1a;"></i>
    <span style="background: transparent;color: #3e3d1a;font-family: 'Albert Sans', sans-serif;font-weight: bold;">Calendar</span>
  </a>
</li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button" style="background: rgb(159,152,117);"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="background: var(--bs-gray-300);color: var(--bs-black);border-color: var(--bs-yellow);box-shadow: inset 0px 0px 9px var(--bs-gray-500);">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="background: rgb(255,255,255);border-color: rgb(255,0,0);">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button" style="color: rgb(159,152,117);--bs-primary: #000000;--bs-primary-rgb: 0,0,0;"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                          
                        </ul>
                    </div>
                </nav>

                           <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#icon1Modal">
                                <div class="text-center">
                                    <i class="fa fa-users fa-3x text-primary"></i>
                                    <p class="mt-2">Active Users</p>
                                </div>
                            </a>
                        </div>


                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#icon5Modal">
                                <div class="text-center">
                                    <i class="fa fa-money fa-3x text-primary">$</i>
                                    <p class="mt-2">Sales</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#icon4Modal">
                                <div class="text-center">
                                    <i class="fa fa-users fa-3x text-info"></i>
                                    <p class="mt-2">Top Pick Services</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#icon2Modal">
                                <div class="text-center">
                                    <i class="fa fa-check-circle fa-3x text-success"></i>
                                    <p class="mt-2">Done Reservations </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#icon3Modal">
                                <div class="text-center">
                                    <i class="fa fa-exclamation fa-3x text-danger"></i>
                                    <p class="mt-2">Canceled Reservations</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#icon6Modal">
                                <div class="text-center">
                                    <i class="fa fa-users fa-3x text-success"></i>
                                    <p class="mt-2">Walk-In Patients</p>
                                </div>
                            </a>
                        </div>



                    </div>
                </div>


                    <div class="centered-div">
                        <h1 class="text-dark">Welcome to your Weekly Report</h1>
                        <br>
                        <p class="mt-2">In here you can view different reports by cling the Icon above</p>
                    </div>

                <div class="modal fade" id="icon1Modal" tabindex="-1" role="dialog" aria-labelledby="icon1ModalLabel" aria-hidden="true">
                    <!-- Add your modal content for Icon 1 here -->
                    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Active Users</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                            <div class="table-responsive">
                            <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Date Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $retrieveServices = "SELECT * FROM `patients_user` WHERE Access = 'User' AND  Active = '1'";
                                $result = $con->query($retrieveServices);
                                // Loop through the rows of the table to display data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Extracting data from the row
                                    $name = $row['Name'];
                                    $email = $row['Email'];
                                    $Phone = $row['PhoneNumber'];
                                    $Address = $row['Address'];
                                    $actTime = $row['activation_timestamp'];

                                    $unixTime = strtotime($actTime);
                                    $dateOnly = date("Y-m-d", $unixTime);

                                    // Displaying the data in a table row
                                    echo '
                                        <tr>
                                            <td>' . $name . '</td>
                                            <td>' . $email . '</td>
                                            <td>' . $Phone . '</td>
                                            <td>' . $Address . '</td>
                                            <td>' . $dateOnly . '</td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal fade" id="icon5Modal" tabindex="-1" role="dialog" aria-labelledby="icon5ModalLabel" aria-hidden="true">
                    <!-- Add your modal content for Icon 1 here -->
                    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Sales</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="container">
                            <div class="table-responsive">
                            <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Payed</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $retrieveServices = "SELECT servicetbl.serviceName, patients_user.Name, bookinglog.totalServicePay
                                FROM bookinglog
                                JOIN servicetbl ON bookinglog.serviceName = servicetbl.serviceName
                                JOIN patients_user ON bookinglog.userID = patients_user.userID
                                WHERE bookinglog.date >= CURDATE() - INTERVAL 1 WEEK AND bookinglog.status = 'Done'";
                                $result = $con->query($retrieveServices);
                                // Loop through the rows of the table to display data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Extracting data from the row
                                    $name = $row['Name'];
                                    $servicename = $row['serviceName'];
                                    $pay = $row['totalServicePay'];

                                    // Displaying the data in a table row
                                    echo '
                                        <tr>
                                            <td>' . $name . '</td>
                                            <td>' . $servicename . '</td>
                                            <td>' . $pay . '</td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                 <div class="modal fade" id="icon6Modal" tabindex="-1" role="dialog" aria-labelledby="icon6ModalLabel" aria-hidden="true">
                    <!-- Add your modal content for Icon 1 here -->
                    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Walk-In Patients</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="container">
                            <div class="table-responsive">
                            <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Walk-In Name</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Payed</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $retrieveServices = "SELECT * FROM bookinglog WHERE walk_in_name != 'None' AND status = 'Done' AND date >= CURDATE() - INTERVAL 1 WEEK";
                                $result = $con->query($retrieveServices);
                                // Loop through the rows of the table to display data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Extracting data from the row
                                    $name = $row['walk_in_name'];
                                    $servicename = $row['serviceName'];
                                    $pay = $row['totalServicePay'];
                                    $date = $row['date'];
                                    $time = $row['timeslot'];

                                    // Displaying the data in a table row
                                    echo '
                                        <tr>
                                            <td>' . $name . '</td>
                                            <td>' . $servicename .'</td>
                                            <td>' . $date .'</td>
                                            <td>' . $time .'</td>
                                            <td>' . $pay . '</td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

    <div class="modal fade" id="icon4Modal" tabindex="-1" role="dialog" aria-labelledby="icon4ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-dark mb-0" style="font-weight: bold;">Top Pick Services</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Service Name</th>
                                            <th>Numbers Acquired</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $weeklyService = "SELECT bookinglog.serviceName, COUNT(*) as Total_Acquired, servicetbl.filename
                                            FROM bookinglog
                                            JOIN servicetbl ON bookinglog.serviceName = servicetbl.serviceName
                                            WHERE date >= CURDATE() - INTERVAL 1 WEEK
                                            GROUP BY serviceName
                                            ORDER BY Total_Acquired";
                                        $resultService = $con->query($weeklyService);

                                        while ($row = mysqli_fetch_assoc($resultService)) {
                                            $serviceName = $row['serviceName'];
                                            $totalAqq = $row['Total_Acquired'];
                                            $file = $row['filename'];

                                            echo '<tr>
                                                    <td>' . $serviceName . '</td>    
                                                    <td>' . $totalAqq . '</td>
                                                    <td><img src="' . $file. '" alt="'.$serviceName.'" style="max-width: 100px; max-height: 200px;"></td>
                                                  </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

        </div>
    </div>
</div>


                <div class="modal fade" id="icon2Modal" tabindex="-1" role="dialog" aria-labelledby="icon2ModalLabel" aria-hidden="true">
                    <!-- Add your modal content for Icon 2 here -->
                     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Done Reservation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Type of Serive</th>
                                            <th>date</th>
                                            <th>Time</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead >
                                    <tbody>
                                       <?php
                                           //Use this code to get the total user weekly
                                            $getWeeklyUser = "SELECT bookinglog.serviceName, bookinglog.date, bookinglog.timeslot, bookinglog.remarks, patients_user.Name 
                                            FROM `bookinglog` 
                                            JOIN patients_user ON bookinglog.userID = patients_user.userID
                                            WHERE date >= CURDATE() - INTERVAL 1 WEEK AND status = 'Done'";
                                            $resultUser = $con -> query($getWeeklyUser);

                                            while ($rowUser = mysqli_fetch_assoc($resultUser)) {
                                                    $name = $rowUser['Name'];
                                                    $service = $rowUser['serviceName'];
                                                    $date = $rowUser['date'];
                                                    $time = $rowUser['timeslot'];
                                                    $remark = $rowUser['remarks'];
                                                    

                                                echo '<tr>
                                                <td>'.$name.'</td>
                                                <td>'.$service.'</td>
                                                <td>'.$date.'</td>
                                                <td>'.$time.'</td> 
                                                <td>'.$remark.'</td>   
                                                </tr>';

                                            }

                                       ?>


                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                          </div>
                        </div>
                      </div>
                </div>

                <div class="modal fade" id="icon3Modal" tabindex="-1" role="dialog" aria-labelledby="icon3ModalLabel" aria-hidden="true">
                    <!-- Add your modal content for Icon 3 here -->
                     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Canceled Reservations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                         <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Type of Serive</th>
                                            <th>date</th>
                                            <th>Time</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead >
                                    <tbody>
                                       <?php
                                           //Use this code to get the total user weekly
                                            $getWeeklyUser = "SELECT bookinglog.serviceName, bookinglog.date, bookinglog.timeslot, bookinglog.remarks, patients_user.Name
                                            FROM `bookinglog` 
                                            JOIN patients_user ON bookinglog.userID = patients_user.userID
                                            WHERE date >= CURDATE() - INTERVAL 1 WEEK AND status = 'Cancel'";
                                            $resultUser = $con -> query($getWeeklyUser);

                                            while ($rowUser = mysqli_fetch_assoc($resultUser)) {
                                                    $name = $rowUser['Name'];
                                                    $service = $rowUser['serviceName'];
                                                    $date = $rowUser['date'];
                                                    $time = $rowUser['timeslot'];
                                                    $remark = $rowUser['remarks'];

                                                    

                                                echo '<tr>
                                                <td>'.$name.'</td>
                                                <td>'.$service.'</td>
                                                <td>'.$date.'</td>
                                                <td>'.$time.'</td> 
                                                <td>'.$remark.'</td>   
                                                </tr>';

                                            }

                                       ?>


                                    </tbody>
                                </table>
                        </div>
                    </div>
                      </div>
                    </div>
                  </div>
                </div>
        </div>
               

           
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://djpsoftwarecdn.azureedge.net/availabilityjs-v1/availability.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
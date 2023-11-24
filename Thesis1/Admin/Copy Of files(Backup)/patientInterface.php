<?php
     include_once("connection/connection.php");
     $con = connection();
     session_start();


     $user = $_SESSION['UserLogin'];
     $userID = $_SESSION['UserID'];




     if(isset($_POST['TimeSlot']))
    {


         
        //  $getserviceSQL = "SELECT serviceID FROM services WHERE serviceName = '$optservices' ";
        //  $exesqlService = mysqli_query($con, $getserviceSQL);

        // while($rowData = $exesqlService->fetch_array()){
        //     $services = $rowData['serviceID'];
        // }
         

        $optservices = $_POST['serviceOpt'];


         $getfirstdate = $_POST['TimeSlot'];
         $getarrDate = explode(",", $getfirstdate);
         $datepick = $_POST['datepicker'];
         $startDate = $getarrDate[0]; 
         $endDate = $getarrDate[1];

         $finalstartDate = $datepick. " " . $startDate;
         $finalendDate = $datepick. " " . $endDate;


         $is_avail = checkslot($finalstartDate,$finalendDate);


        

         if($is_avail == true)
         {
            echo '<script>alert("Dup")</script>'; //if dup select another timeslot and disable button
         }
         else
         {
           
            $query = "INSERT INTO `reservation`(`start_date`, `end_date`, `serviceName`, `userID`,`status`) VALUES ('$finalstartDate','$finalendDate','$optservices', '$userID','Pending')";
            $run_query = mysqli_query($con, $query); //add a modal for confirmation of reservation
         }

        
    }

    function checkslot($cstart_time, $cend_time)
    {
        global $con; //need to fix the condition check in reservation table


        $sql = "SELECT * FROM `reservation` WHERE start_date = '$cstart_time' AND end_date = '$cend_time'";
        $exeSQL = $con->query($sql);
        $total = $exeSQL->num_rows;
        
      
        if($total > 0)
        { //meaning there's is a existing reservation slots
            return true;
        }
        else
        {//there are no existing reservation slots
            return false;
        }


        
    }









 


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
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

    <link rel="stylesheet" href="assets/css/Ultimate-Event-Calendar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
   $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'connection/PatientLoad.php',
    selectable:true,
    selectHelper:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },
   });
  });
   
  </script>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="border-color: rgb(255,255,255);background: linear-gradient(#d8cfac 57%, white 100%), #a6a263;border-radius: -1px;">
            <div class="container-fluid d-flex flex-column p-0"><img src="assets/img/Picsart_23-04-17_12-49-06-946.png" width="85" height="91" style="margin-left: 0px;padding-bottom: 0px;padding-top: 10px;">
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="patientInterface.php" style="background: #ffffff;border-radius: 8px;margin-top: 13px;border-color: var(--bs-blue);border-top-width: 1px;border-top-color: #95947c;border-bottom: 1px outset rgba(149,148,124,0.33);box-shadow: 0px 0px 10px rgb(159,152,117);--bs-body-bg: #fff;"><i class="far fa-calendar" style="color: #3e3d1a;"></i><span style="background: transparent;color: #3e3d1a;font-family: 'Albert Sans', sans-serif;font-weight: bold;">Calendar</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="patientServices.php"><i class="fas fa-hands" style="color: #3e3d1a;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">Services</span></a><a class="nav-link active" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="PatientsOwnReservation.php"><i class="icon ion-ios-paper-outline" style="color: #3e3d1a;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">My Reservation</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button" style="background: rgb(159,152,117);"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="background: var(--bs-gray-300);color: var(--bs-black);border-color: var(--bs-yellow);box-shadow: inset 0px 0px 9px var(--bs-gray-500);">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="background: rgb(255,255,255);border-color: rgb(255,0,0);">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button" style="color: rgb(159,152,117);--bs-primary: #000000;--bs-primary-rgb: 0,0,0;"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                        </form>
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
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a><a class="dropdown-item" href="#">Menu Item</a><span class="dropdown-item-text">Text Item</span>
                                        <h6 class="dropdown-header">Header</h6>
                                        <div class="dropdown-divider"></div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">7</span><i class="fas fa-envelope fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem I've been having.</span></div>
                                                <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar2.jpeg">
                                                <div class="status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>I have the photos that you ordered last month!</span></div>
                                                <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar3.jpeg">
                                                <div class="bg-warning status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Last month's report looks great, I am very happy with the progress so far, keep up the good work!</span></div>
                                                <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar5.jpeg">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</span></div>
                                                <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small" style="font-weight: bold;color: var(--bs-black);"><?php
                                    echo $user;
                                ?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="patientProfile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="Landingpage.html"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0" style="font-weight: bold;">Calendar</h3>
                    </div>
                    <div id="calendar"></div>
                    <div style="position: relative;display: flex;"><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal-1" style="background: rgb(159,152,117);border-color: rgb(159,152,117);border-radius: 6px;margin-right: -3px;position: relative;display: grid;">RESERVE</button>
                        <div class="modal fade" role="dialog" tabindex="-1" id="modal-1" style="border-radius: 0px;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                <form action="" method="post">
                                    <div class="modal-header" style="height: 80px;border-radius: 12px 7px 0px 0px;">
                                        <h4 class="modal-title mb-0" style="font-weight: bold;color: rgb(77,77,77);">RESERVE</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="height: 312px;width: 498px;background: #ffffff;">
                                    

                                        <label for="datepicker">Please Select a date and time</label>
                                        <input type="date" id="datepicker" name="datepicker"> <br>

                                        <br>

                                        <select name="serviceOpt" id="">
                                        <?php
                                            $sqlquery = "SELECT serviceName FROM servicetbl";  
                                            $result = $con->query($sqlquery);
                                            if($result -> num_rows> 0)
                                            {
                                                while($optionData = $result->fetch_assoc())
                                                {
                                                    $option = $optionData['serviceName'];
                                                    

                                        ?>

                                        <option value="<?php echo $option?>"> <?php echo $option?></option>

                                        <<?php
                                            }}
                                        ?>
                                        </select>
                                       
                                        <br>

                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="08:00:00,08:30:00">08:00:00,08:30:00</button>
                                       
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="08:30:00,09:00:00">08:30:00,09:00:00</button>
                                       
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="09:00:00,09:30:00">09:00:00,09:30:00</button>
                                        <br>
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="09:30:00,10:00:00">09:30:00,10:00:00</button>
                                       
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="10:00:00,10:30:00">10:00:00,10:30:00</button>
                                     
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="10:30:00,11:00:00">10:30:00,11:00:00</button>
                                        <br>
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="11:00:00,11:30:00">11:00:00,11:30:00</button>
                                       
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="11:30:00,12:00:00">11:30:00,12:00:00</button>
                                       
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="01:00:00,01:30:00">01:00:00,01:30:00</button>
                                      
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="01:30:00,02:00:00">01:30:00,02:00:00</button>
                                     
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="02:00:00,02:30:00">02:00:00,02:30:00</button>
                                    
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="02:30:00,03:00:00">02:30:00,03:00:00</button>
                                        <br>
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="03:00:00,03:30:00">03:00:00,03:30:00</button>
                                  
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="03:30:00,04:00:00">03:30:00,04:00:00</button>
                                     
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="04:00:00,04:30:00">04:00:00,04:30:00</button>
                                   
                                        <button style="background-color: #60be25 ;" name="TimeSlot" type="submit" value="04:30:00,05:00:00">04:30:00,05:00:00</button>
                                        <br>
                                    </div>
                                    <div class="modal-footer"><button class="btn btn-primary" name = "Reserve" type="submit" style="background: rgb(159,152,117);border-color: rgb(159,152,117);border-radius: 5px;">Reserve</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12 col-xl-12"></div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Title</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The content of your modal.</p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://djpsoftwarecdn.azureedge.net/availabilityjs-v1/availability.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
</body>

</html>
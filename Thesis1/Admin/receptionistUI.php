<?php
include_once("connection/connection.php");
$con = connection();

session_start();
date_default_timezone_set('Asia/Manila');

$user = $_SESSION['UserLogin'];
$userID = $_SESSION['UserID'];
$todaysDate = date("Y-m-d"); // add plus one because of timezone.... 

if (isset($_GET['logout_code'])) {
    session_unset();
    session_destroy();
    // Redirect to the landing page
    header("Location: Landingpage.php");
    exit(); // Make sure to exit after sending the header
}

if (isset($_GET['canID'])) {
    $usID = $_GET['canID'];

    $checkRemarksStmt = "SELECT COUNT(*) as count FROM bookinglog WHERE remarks IS NOT NULL AND remarks <> '' AND resID = $usID";
    $execheck = $con->query($checkRemarksStmt);

    if ($execheck) {
        $row = $execheck->fetch_assoc();
        $total = $row['count'];

        if ($total > 0) {
            $changeStatusCan = "UPDATE `bookinglog` SET `status`='Cancel' WHERE resID = '$usID'";
            $exeQuery2 = mysqli_query($con, $changeStatusCan);
            echo "<script>alert('Remarks successfully added'); window.location.href='receptionistUI.php';</script>";
        } else {
            echo "<script>alert('Please add a remark')</script>";
        }
    } else {
        echo "Error executing query: " . $con->error;
    }
}


// Define arrays for table headers
$headerToday = ["Reservation ID", "Name", "Family Member", "Type of Service", "Phone Number", "Address", "Time","Add Remarks"];
$headerAll = ["Reservation ID", "Name", "Type of Service", "Family Member", "Phone Number", "Address", "Date", "Time","Add Remarks"];
$headerAdminReservation = ["Reservation ID", "Name", "Type of Service", "Admin Remarks", "Phone Number", "Address", "Date", "Time"];
$headerWalkInPatients = ["Reservation ID", "Walk-in Name", "Type of Service", "Phone Number", "Address", "Date", "Time"];

// Determine which set of patients to display
$isToday = isset($_POST['btn-Patients-Today']);
$isAdminReservation = isset($_POST['btn-Admin-Reservation']);
$isAll = isset($_POST['btn-Patients-All']);
$isWalkInPatients = isset($_POST['btn-Walk-in-Patients']);

// Initialize default values

if(isset($_GET['resIDQR']))
{
    $qrID = $_GET['resIDQR'];
    $header = $headerToday;
    $pageTitle = "Today's Patients";
    $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot,bookinglog.admin_remarks, bookinglog.walk_in_name,bookinglog.FamMemberName
    FROM bookinglog
    INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
    WHERE status = 'Pending' AND DATE(bookinglog.date) = '$todaysDate' AND resID = '$qrID'"; // Initialize with an empty string


    $stmtCheckToday = "SELECT * from bookinglog where DATE(date) = '$todaysDate' and resID = '$qrID'";
    $exestmt = $con -> query($stmtCheckToday);
    $total = $exestmt -> num_rows;

    if($total <= 0)
    {
        echo '<div class="alert alert-danger" role="alert">
        No Reservation found!!
        </div>';
    }

}else{

    $searchKeywordAll = isset($_POST['searchKeywordAll']) ? $_POST['searchKeywordAll'] : '';
    $header = $headerAll;
    $pageTitle = "All Patients";
    $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot, bookinglog.admin_remarks, bookinglog.walk_in_name, bookinglog.FamMemberName
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE status = 'Pending' AND DATE(bookinglog.date) = '$todaysDate' AND admin_remarks = 'None' AND walk_in_name = 'None'";
        $isAll = true;
        $istoday = false;

    if (!empty($searchKeywordAll)) {
        $retrieveQuery .= " AND patients_user.Name LIKE '%$searchKeywordAll%'";
        $isAll = true;
    }

    if(isset($_POST['searchKeywordAll']))

    {
        $searchKeywordAll = isset($_POST['searchKeywordAll']) ? $_POST['searchKeywordAll'] : '';
        $header = $headerAll;
        $pageTitle = "All Patients";
        $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot, bookinglog.admin_remarks, bookinglog.walk_in_name, bookinglog.FamMemberName
            FROM bookinglog
            INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
            WHERE status = 'Pending' AND DATE(bookinglog.date) = '$todaysDate' AND admin_remarks = 'None' AND walk_in_name = 'None'";
            $isAll = true;
            $istoday = false;
    
        if (!empty($searchKeywordAll)) {
            $retrieveQuery .= " AND patients_user.Name LIKE '%$searchKeywordAll%'";
            $isAll = true;
        }
    
    }
    elseif (isset($_POST['searchKeywordToday'])) {

        $searchKeywordToday = isset($_POST['searchKeywordToday']) ? $_POST['searchKeywordToday'] : '';
        $isAll = false;
        $istoday = true;
        $header = $headerToday;
        $pageTitle = "Today's Patients";
        $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot,bookinglog.admin_remarks, bookinglog.walk_in_name,bookinglog.FamMemberName
                FROM bookinglog
                INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
                WHERE status = 'Pending' AND DATE(bookinglog.date) = '$todaysDate'AND admin_remarks = 'None' AND walk_in_name = 'None'"; // Initialize with an empty string
    
    
    if (!empty($searchKeywordToday)) {
        $retrieveQuery .= " AND patients_user.Name LIKE '%$searchKeywordToday%'";
    }
    }



    if($isToday)
{

    $searchKeywordToday = isset($_POST['searchKeywordToday']) ? $_POST['searchKeywordToday'] : '';
    $isAll = false;
    $istoday = true;
    $header = $headerToday;
    $pageTitle = "Today's Patients";
    $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot,bookinglog.admin_remarks, bookinglog.walk_in_name,bookinglog.FamMemberName
            FROM bookinglog
            INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
            WHERE status = 'Pending' AND DATE(bookinglog.date) = '$todaysDate'AND admin_remarks = 'None' AND walk_in_name = 'None'"; // Initialize with an empty string


if (!empty($searchKeywordToday)) {
    $retrieveQuery .= " AND patients_user.Name LIKE '%$searchKeywordToday%'";
}

}
// Choose the header based on the button clicked
elseif ($isAdminReservation) {

    $header = $headerAdminReservation;
    $isAll = false;
    $istoday = false;
    $pageTitle = "Admin Patients";
    $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot, bookinglog.admin_remarks
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE status = 'Pending' AND DATE(bookinglog.date) >= '$todaysDate' AND admin_remarks != 'None'";

} elseif ($isWalkInPatients) {

    $header = $headerWalkInPatients;
    $isAll = false;
    $istoday = false;
    $pageTitle = "Walk-In Patients";
     $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot,bookinglog.walk_in_name
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE status = 'Pending' AND DATE(bookinglog.date) = '$todaysDate' AND walk_in_name != 'None'";
    // Add the corresponding code for the Walk-In Patients button here if needed
} 
elseif ($isAll) {
    $searchKeywordAll = isset($_POST['searchKeywordAll']) ? $_POST['searchKeywordAll'] : '';
    $header = $headerAll;
    $pageTitle = "All Patients";
    $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot, bookinglog.admin_remarks, bookinglog.walk_in_name, bookinglog.FamMemberName
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE status = 'Pending' AND DATE(bookinglog.date) >= '$todaysDate' AND admin_remarks = 'None' AND walk_in_name = 'None'";

    if (!empty($searchKeywordAll)) {
        $retrieveQuery .= " AND patients_user.Name LIKE '%$searchKeywordAll%'";
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity = "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin = "anonymous">

    <link rel="stylesheet" href="assets/css/Feature-Section-MD.css">
    <link rel="stylesheet" href="https://djpsoftwarecdn.azureedge.net/availabilitycss-v1/availability.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Event-Calendar.css">
    <style>
        .hidden-column {
            display: none;
        }
    </style>
    <script src="assets/js/html5-qrcode.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://djpsoftwarecdn.azureedge.net/availabilityjs-v1/availability.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>      


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
                            <a class="nav-link" aria-expanded="false" data-toggle="modal" data-target="#exampleModal"  href="#" style="color: rgb(0,0,0);"><i class="icon ion-qr-scanner" style="font-size: 37px;"></i></a>
                            <li class="nav-item dropdown no-arrow">
                                
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small" style="font-weight: bold;color: var(--bs-black);"><?php
                                  echo  $user;
                                ?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="receptionistUI.php?logout_code"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                

                    <div class="card shadow">
                        <div class="card-body" style="height: 1000px;">
                            <div class="row">
                                
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                </div>
                     
                                <form method="post" >
                                    <div class="input-group mb-3">

                                    <?php 
                                        if($isAll == true)
                                        {
                                            echo '<input type="text" class="form-control" placeholder="Search by Name" name="searchKeywordAll">
                                            <button class="btn btn-outline-secondary" type="submit" name="btn-Search">Search</button>';
                                        }
                                        elseif($istoday == true)
                                        {
                                            echo '<input type="text" class="form-control" placeholder="Search by Name" name="searchKeywordToday">
                                            <button class="btn btn-outline-secondary" type="submit" name="btn-Search">Search</button>';
                                        }
                                    ?>
                                    </div>
                                </form>
                           
                            </div>
   <form method="post" action="">
            <button class="btn btn-primary btn-lg" type="submit" name="btn-Patients-Today">Show Today's Patients</button>
            <button class="btn btn-info btn-lg" type="submit" name="btn-Patients-All">Show All Patients</button>
            <button class="btn btn-primary btn-lg" type="submit" name="btn-Admin-Reservation">Admin Reservation</button>
            <button class="btn btn-info btn-lg" type="submit" name="btn-Walk-in-Patients">Walk-In Patients</button>

        </form>

        <h3 class="text-dark mb-0" style="font-weight: bold;"><?php echo $pageTitle; ?></h3>

        <div class="card shadow">
            <div class="card-body" style="height: 800px;">
                <div class="row">
                    <div class="col-md-6 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="height: 800px;">
                    <table class="table my-0" id="dataTable">
                      <thead class="thead-dark">
                        <tr>
                            <?php
                            // Loop through the selected set of headers
                            foreach ($header as $column) {
                                echo "<th>$column</th>";
                            }
                            ?>
                            <th></th>
                        </tr>
                    </thead>
                        <tbody>
                           <?php





                                    $result =  $con->query($retrieveQuery);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        foreach ($header as $column) {
                                            // Print corresponding value based on the column header
                                          switch ($column) {
                                                case "Reservation ID":
                                                    echo '<td>' . $row['resID'] . '</td>';
                                                    break;
                                                case "Name":
                                                    echo '<td>' . $row['Name'] . '</td>';
                                                    break;
                                                case "Walk-in Name":
                                                    echo '<td>' . $row['walk_in_name'] . '</td>';
                                                    break;
                                                case "Admin Remarks":
                                                    echo '<td>' . $row['admin_remarks'] . '</td>';
                                                    break;
                                                case "Type of Service":
                                                    echo '<td>' . $row['serviceName'] . '</td>';
                                                    break;
                                                case "Phone Number":
                                                    echo '<td>' . $row['PhoneNumber'] . '</td>';
                                                    break;
                                                case "Address":
                                                    echo '<td>' . $row['Address'] . '</td>';
                                                    break;
                                                case "Date":
                                                    echo '<td>' . $row['date'] . '</td>';
                                                    break;
                                                case "Time":
                                                    echo '<td>' . $row['timeslot'] . '</td>';
                                                    break;
                                                case "Family Member":
                                                    echo '<td>' . $row['FamMemberName'] . '</td>';
                                                    break;
                                                case "Add Remarks":
                                                    echo '<td>
                                                            <input type="text" class="inputField" id="inputField' . $row['resID'] . '">
                                                        </td>';
                                                    break;


                                            }
                                        }

                                        if($isAll == true)
                                        {
                                            echo '<td>
                                                <input type="hidden" id="resID' . $row['resID'] . '" name="resID" value="' . $row['resID'] . '">
                                                <button"><a href="receptionistUI.php?canID=' . $row['resID'] . '" class="btn btn-warning">Cancel</a></button>
                                                </td>';
                                        echo '</tr>';
                                        }
                                        elseif($istoday == true)
                                        {
                                            echo '<td>
                                            <input type="hidden" id="resID' . $row['resID'] . '" name="resID" value="' . $row['resID'] . '">
                                            <button"><a href="PaymentRecept.php?doneID=' . $row['resID'] . '" class="btn btn-danger">Payment</a></button>
                                            <button"><a href="receptionistUI.php?canID=' . $row['resID'] . '" class="btn btn-warning">Cancel</a></button>
                                        </td>';
                                    echo '</tr>';
                                        }

                                       
                                    }
                                    ?>
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>     
                
                
            
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="reader"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
            const scanner = new Html5QrcodeScanner('reader', {
            fps: 20,
            rememberLastUsedCamera: true,
            });
            scanner.render(success, error);
            function success(result) {
            scanner.clear();
            document.getElementById('reader').remove();


            window.location.href = 'receptionistUI.php?resIDQR=' + encodeURIComponent(result);

            }
            function error(err) {
            console.error(err);
            }
            </script>

    <script>
    $(document).ready(function(){
        $('.inputField').on('input', function(){
            var inputValue = $(this).val();
            
            // Find the parent row of the input field
            var parentRow = $(this).closest('tr');
            // Get the reservation ID from the hidden input in the same row
            var ResID = parentRow.find('[name="resID"]').val();

            $.ajax({
                url: 'connection/remarksProcess.php',
                type: 'POST',
                data: {
                    inputValue: inputValue,
                    resID: ResID
                }
            });
        });
    });
</script>
</body>

</html>
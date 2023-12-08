<?php
include_once("connection/connection.php");
$con = connection();

$todaysDate = date("Y-m-d", strtotime("+1 day")); // add plus one because of timezone....

// Define arrays for table headers
$headerToday = ["Reservation ID", "Name", "Services", "Phone Number", "Address", "Time", "Add Remarks"];
$headerAll = ["Reservation ID", "Name", "Services", "Phone Number", "Address", "Date", "Time", "Add Remarks"];
$headerAdminReservation = ["Reservation ID", "Name", "Services", "Admin Remarks", "Phone Number", "Address", "Date", "Time", "Add Remarks"];
$headerWalkInPatients = ["Reservation ID", "Walk-in Name", "Services", "Phone Number", "Address", "Date", "Time", "Add Remarks"];

// Determine which set of patients to display
$isToday = isset($_POST['btn-Patients-Today']);
$isAdminReservation = isset($_POST['btn-Admin-Reservation']);
$isAll = isset($_POST['btn-Patients-All']);
$isWalkInPatients = isset($_POST['btn-Walk-in-Patients']);

// Initialize default values
$header = $headerToday;
$pageTitle = "Today's Patients";
$retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot,bookinglog.admin_remarks, bookinglog.walk_in_name
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE status = 'Pending' AND DATE(bookinglog.date) = '$todaysDate'"; // Initialize with an empty string

// Choose the header based on the button clicked
if ($isAll) {
    $header = $headerAll;
    $pageTitle = "All Patients";
    $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot,bookinglog.admin_remarks, bookinglog.walk_in_name
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE status = 'Pending' AND DATE(bookinglog.date) > '$todaysDate'";
} elseif ($isAdminReservation) {
    $header = $headerAdminReservation;
    $pageTitle = "Admin Patients";
    $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot, bookinglog.admin_remarks
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE status = 'Pending' AND DATE(bookinglog.date) > '$todaysDate' AND admin_remarks != 'None'";
} elseif ($isWalkInPatients) {
    $header = $headerWalkInPatients;
    $pageTitle = "Walk-In Patients";
     $retrieveQuery = "SELECT bookinglog.resID, bookinglog.serviceName, patients_user.Name, bookinglog.date, patients_user.PhoneNumber, patients_user.Email, patients_user.Address, bookinglog.timeslot,bookinglog.walk_in_name
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE status = 'Pending' AND DATE(bookinglog.date) > '$todaysDate' AND walk_in_name IS NOT NULL AND walk_in_name <> ''";
    // Add the corresponding code for the Walk-In Patients button here if needed
} else {
    // Handle other cases or set default values
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
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
    <link rel="stylesheet" href="assets/css/Basic-Footer.css">
    <link rel="stylesheet" href="assets/css/Black-Navbar.css">
    <link rel="stylesheet" href="assets/css/Block-Responsive-Item-List.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Calendar.css">
    <link rel="stylesheet" href="assets/css/carousel-circulo.css">
    <link rel="stylesheet" href="assets/css/Carousel-Hero-1.css">
    <link rel="stylesheet" href="assets/css/Carousel-Hero.css">
    <link rel="stylesheet" href="assets/css/Diagonal-div-section.css">
    <link rel="stylesheet" href="assets/css/Feature-Section-MD.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Event-Calendar.css">
    <style>
        .hidden-column {
            display: none;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="border-color: rgb(255,255,255);background: linear-gradient(#d8cfac 57%, white 100%), #a6a263;border-radius: -1px;">
            <div class="container-fluid d-flex flex-column p-0"><img src="assets/img/Picsart_23-04-17_12-49-06-946.png" width="85" height="91" style="margin-left: 0px;padding-bottom: 0px;padding-top: 10px;">
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php" style="background: #ffffff;border-radius: 8px;margin-top: 13px;border-color: var(--bs-blue);border-top-width: 1px;border-top-color: #95947c;border-bottom: 1px outset rgba(149,148,124,0.33);box-shadow: 0px 0px 10px rgb(159,152,117);--bs-body-bg: #fff;"><i class="far fa-calendar" style="color: #3e3d1a;"></i><span style="background: transparent;color: #3e3d1a;font-family: 'Albert Sans', sans-serif;font-weight: bold;">Calendar</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="Listofpatients.php"><i class="fas fa-table" style="color: #3e3d1a;font-size: 13px;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">List of Patients</span></a><a class="nav-link" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="patientstoday.php"><i class="fas fa-user" style="color: #3e3d1a;font-size: 13px;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">Patient's Schedule</span></a><a class="nav-link active" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="Servicemaintenance.php"><i class="icon ion-settings" style="color: #3e3d1a;font-size: 18px;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">Service Maintenance</span></a><a class="nav-link" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="Reports.php"><i class="icon ion-document-text" style="color: #3e3d1a;font-size: 19px;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">Reports</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="background: rgb(255,255,255);border-color: rgb(255,0,0);">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button" style="color: rgb(159,152,117);--bs-primary: #000000;--bs-primary-rgb: 0,0,0;"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                                                    <li class="nav-item dropdown no-arrow mx-1"><a class="nav-link" href="ChatsystemAdmin.php"><i class="icon ion-email" style="font-size: 30px;color: #a6a263;margin-top: 8px;"></i></a></li>

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
                                
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small" style="font-weight: bold;color: var(--bs-black);">Dr. Charry Tubiera</span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
              
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

                                if (isset($_GET['doneID'])) {
                                $usID = $_GET['doneID'];

                                $checkRemarksStmt = "SELECT COUNT(*) as count FROM bookinglog WHERE remarks IS NOT NULL AND remarks <> '' AND resID = $usID";
                                $execheck = $con->query($checkRemarksStmt);

                                if ($execheck) {
                                    $row = $execheck->fetch_assoc();
                                    $total = $row['count'];

                                    if ($total > 0) {
                                        $changeStatus = "UPDATE `bookinglog` SET `status`='Done' WHERE resID = '$usID'";
                                        $exeQuery = mysqli_query($con, $changeStatus);
                                    } else {
                                        echo "<script>alert('Please add a remark')</script>";
                                    }
                                } else {
                                    echo "Error executing query: " . $con->error;
                                }
                            } elseif (isset($_GET['canID'])) {
                                $usID = $_GET['canID'];

                                $checkRemarksStmt = "SELECT COUNT(*) as count FROM bookinglog WHERE remarks IS NOT NULL AND remarks <> '' AND resID = $usID";
                                $execheck = $con->query($checkRemarksStmt);

                                if ($execheck) {
                                    $row = $execheck->fetch_assoc();
                                    $total = $row['count'];

                                    if ($total > 0) {
                                        $changeStatusCan = "UPDATE `bookinglog` SET `status`='Canceled' WHERE resID = '$usID'";
                                        $exeQuery2 = mysqli_query($con, $changeStatusCan);
                                        echo "<script>alert('Remarks successfully added')</script>";
                                    } else {
                                        echo "<script>alert('Please add a remark')</script>";
                                    }
                                } else {
                                    echo "Error executing query: " . $con->error;
                                }
                            }

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
                                                case "Services":
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
                                                case "Add Remarks":
                                                    echo '<td>
                                                            <input type="text" class="inputField" id="inputField' . $row['resID'] . '">
                                                        </td>';
                                                    break;
                                            }
                                        }
                                        echo '<td>
                                                <input type="hidden" id="resID' . $row['resID'] . '" name="resID" value="' . $row['resID'] . '">
                                                <button"><a href="patientstoday.php?doneID=' . $row['resID'] . '" class="btn btn-danger">Done</a></button>
                                                <button"><a href="patientstoday.php?canID=' . $row['resID'] . '" class="btn btn-warning">Cancel</a></button>
                                            </td>';
                                        echo '</tr>';
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

        <!-- ... (rest of your body and script tags) ... -->

    </div>
                          
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://djpsoftwarecdn.azureedge.net/availabilityjs-v1/availability.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://djpsoftwarecdn.azureedge.net/availabilityjs-v1/availability.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>     
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
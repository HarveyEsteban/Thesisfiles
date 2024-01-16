<?php
    include_once("connection/connection.php");
    include_once("connection/emailValidation.php");
    $con = connection();


    


    if (isset($_POST['submit-btn'])) {
        $serviceName = $_POST['nametxt'];
        $servicePrice = $_POST['pricetxt'];
        $serviceDescription = $_POST['descriptiontxt'];

        $file = $_FILES['image'];

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg','png');
    
        $stmtCheckDup = "SELECT * FROM `servicetbl` WHERE serviceName = '$serviceName'";
        $exestmt = $con->query($stmtCheckDup) or die($con->error);
        $row = $exestmt->fetch_assoc();

        $total = $exestmt->num_rows;

        

        if($total > 0 ){
            echo '<script>alert("Service Already exist")</script>';       
        
        }
        elseif ($fileName == null) {
            echo '<script>alert("Please Upload a picture for the Service")</script>'; 
        }
        else{
            // $stmtinsert = "INSERT INTO `servicetbl`(`serviceName`, `price`, `estTime`) VALUES ('$serviceName','$servicePrice','$serviceDuration')";
            // $exequerry = mysqli_query($con, $stmtinsert);
            // echo '<script>alert("Service Succesfully Uploaded")</script>'; 

            if(in_array($fileActualExt, $allowed))
            {
                if($fileError === 0)
                {
                    if($fileSize < 1000000)
                    {
                        $fileNameNew = uniqid('', true). "." . $fileActualExt;
                        $fileDestination = 'upload/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

    
                        $sqlStmtImg = "INSERT INTO `servicetbl`(`serviceName`, `price`, `filename`, `description`) VALUES ('$serviceName','$servicePrice','$fileDestination','$serviceDescription')";
                        $exeStmt = $con -> query($sqlStmtImg);
                        echo '<script>alert("Service Succesfully Uploaded")</script>'; 
                    }
                    else{
                        echo "Your file is too big!" ;
                    }
                }
                else
                {
                    echo "There was an error uploading the file";
                }
            }
            else{
                echo "You cannot upload files of this type";
            }

        }

    }

    if(isset($_GET['archiveName']))
    {
        $archiveName = $_GET['archiveName'];

        $archivestmt = "UPDATE `servicetbl` SET `status`='Archive' WHERE serviceName = '$archiveName'";
        $exestmt = $con->query($archivestmt);

    }

    if(isset($_GET['unArchive'])){

        $unArchiveName = $_GET['unArchive'];

        $unarchivestmt = "UPDATE `servicetbl` SET `status`='Un-Archive' WHERE serviceName = '$unArchiveName'";
        $exestmt = $con->query($unarchivestmt);

    }


    if(isset($_POST['submitUser-btn']))
    {
        
        $nameUser = $_POST['nameUsertxt'];
        $emailUser = $_POST['emailUsertxt'];
        $optAccess = $_POST['optAccess'];
        $password = $_POST['passUsertxt'];
        
        $checkemail = isValidEmail($_POST['emailUsertxt']);

        if(empty($nameUser) || empty($emailUser) || empty($password))
        {
            echo '<script>alert("Please fill out the form")</script>';
        
        }
        else{
            if($checkemail == true){

                $sqlverifyemail = "SELECT `email` FROM `patients_user` WHERE email = '$email'";
                $verifyEmail = $con->query($sqlverifyemail);
                
                $row = $verifyEmail->fetch_assoc();
  
                $total = $verifyEmail->num_rows;

                

                if($total > 0){
                    echo '<script>alert("Emal already have an account")</script>';
                }
                else{
                    
                    $stmtinserUser = "INSERT INTO `patients_user`(`Email`, `Name`,`Password`,`Access`, `Active`) VALUES ('$emailUser','$nameUser','$password','$optAccess','1')";
                    $exequery = $con -> query($stmtinserUser);
                    echo '<script>alert("Succesfully created an account")</script>';

                }
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
                    <li class="nav-item"><a class="nav-link" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="Listofpatients.php"><i class="fas fa-table" style="color: #3e3d1a;font-size: 13px;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">List of Patients</span></a><a class="nav-link active" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="Servicemaintenance.php"><i class="icon ion-settings" style="color: #3e3d1a;font-size: 18px;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">Maintenance</span></a><a class="nav-link" style="background: #ffffff;font-weight: bold;color: var(--bs-black);border-radius: 8px;border-bottom: 1px outset rgba(149,148,124,0.49);box-shadow: 0px 0px 10px rgb(159,152,117);" href="Reports.php"><i class="icon ion-document-text" style="color: #3e3d1a;font-size: 19px;"></i><span style="color: #3e3d1a;font-family: 'Albert Sans', sans-serif;">Reports</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="background: var(--bs-gray-300);color: var(--bs-black);border-color: var(--bs-yellow);box-shadow: inset 0px 0px 9px var(--bs-gray-500);">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="background: rgb(255,255,255);border-color: rgb(255,0,0);">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button" style="color: rgb(159,152,117);--bs-primary: #000000;--bs-primary-rgb: 0,0,0;"><i class="fas fa-bars"></i></button>
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
                            <div class="d-none d-sm-block topbar-divider"></div>
                        </ul>
                    </div>
                </nav>

<div class="container-fluid">
    <div class="d-sm-flex justify-content-around mb-4">
        <h3 class="text-dark mb-0" style="font-weight: bold;">Service Maintenance</h3>
        <h3 class="text-dark mb-0" style="font-weight: bold;">Add Account</h3>
    </div>
</div>
     <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <!-- Service Maintenance Section -->
            <div class="container">
                <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <!-- ... (form fields) ... -->
            <div class="mb-3">
                                    <label for="nametxt" class="form-label">Name</label>
                                    <input name="nametxt" id="nametxt" type="text" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please enter a name.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="pricetxt" class="form-label">Price</label>
                                    <input name="pricetxt" id="pricetxt" type="text" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please enter a price.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="descriptiontxt" class="form-label">Description</label>
                                    <input name="descriptiontxt" id="descriptiontxt" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input required type="file" name="image" id="image" class="form-control">
                                    <div class="invalid-feedback">
                                        Please choose an image.
                                    </div>
                                </div>
                    <button class="btn btn-primary" name="submit-btn" id="submit-btn" type="submit">Add Service</button>
                </form>
                <div class="col">
                    <div style="margin-bottom: 36px;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Add New Account Section -->
            <div class="container">
                <!-- ... (previous Add New Account section content) ... -->
                            <!-- ... (form fields) ... -->
    </div>
<form action="" method="post">
    <div class="mb-3">
         <label for="emailUsertxt" class="form-label">Email</label>
        <input type="text" name="emailUsertxt" id="emailUsertxt" class="form-control" style="margin-bottom: 8px;">
    </div>
    <div class="mb-3">
        <label for="nameUsertxt" class="form-label">Name</label>
        <input type="text" name="nameUsertxt" id="nameUsertxt" class="form-control" style="padding-top: 1px; margin-bottom: 8px;">
    </div>
    <div class="mb-3">
        <label for="passUsertxt" class="form-label">Password</label>
        <input type="text" name="passUsertxt" id="passUsertxt" class="form-control" style="padding-top: 1px; margin-bottom: 8px;">
    </div>
    <div class="mb-3">
        <label for="optAccess" class="form-label">Access</label>
        <select name="optAccess" id="optAccess" class="form-select">
            <option value="Receptionist">Receptionist</option>
            <option value="Admin">Admin</option>
        </select>
    </div>
                    <button class="btn btn-primary" name="submitUser-btn" id="submitUser-btn" type="submit">Add Service</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
  <div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0" style="font-weight: bold;">Available Services</h3>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Description</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody> <?php
                                 $retrieveServices = "SELECT * FROM `servicetbl` WHERE status = 'Un-Archive'";
                                $result = $con -> query($retrieveServices);
                                // Loop through the rows of the table to display data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Extracting data from the row
                                    $name = $row['serviceName'];
                                    $price = $row['price'];
                                    $est = $row['description'];
                                    $pic = $row['filename'];

                                    // Displaying the data in a table row
                                    echo '
                <tr>
                    <td>' . $name . '</td>
                    <td>₱' . number_format($price, 2) . '</td>
                    <td>' . $est . '</td>
                    <td>
                        <img src="' . $pic . '" alt="' . $name . '" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td>
                            <button">
                                <a href="ServiceEdit.php?serviceName=' . $name . '" class="btn btn-danger">Edit</a>
                            </button>
                            <button">
                                <a href="Servicemaintenance.php?archiveName=' . $name . '" class="btn btn-warning">Un-Avaiable</a>
                            </button>
                        </td>
                    </tr>';
                                }
                                ?> </tbody>
    </table>
  </div>
  <div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0" style="font-weight: bold;">Archive Services</h3>
  </div>
</div>
<div class="container">
  <div class="table-responsive">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Description</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody> <?php
                                 $retrieveServices = "SELECT * FROM `servicetbl` WHERE status = 'Archive'";
                                $result = $con -> query($retrieveServices);
                                // Loop through the rows of the table to display data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Extracting data from the row
                                    $name = $row['serviceName'];
                                    $price = $row['price'];
                                    $est = $row['description'];
                                    $pic = $row['filename'];

                                    // Displaying the data in a table row
                                    echo '
                    <tr>
                        <td>' . $name . '</td>
                        <td>' . $price . '</td>
                        <td>' . $est . '</td>
                        <td>
                            <img src="' . $pic . '" alt="' . $name . '" style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>
                                <button">
                                    <a href="ServiceEdit.php?serviceName=' . $name . '" class="btn btn-danger">Edit</a>
                                </button>
                                <button">
                                    <a href="Servicemaintenance.php?unArchive=' . $name . '" class="btn btn-warning">Available</a>
                                </button>
                            </td>
                        </tr>';
                                }
                                ?> </tbody>
    </table>
  </div>
</div>

    <div class="container">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0" style="font-weight: bold;">Receptionist Account List</h3>
    </div>
        <table class="table">
            <!-- ... (table header) ... -->
             <thead class="thead-dark">
        <tr>
            <th></th>
            <th></th>
          <th>Email</th>
          <th>Name</th>
          <th>Password</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
            <tbody>
               <?php


                                        if(isset($_GET['UsernameID']))
                                        {
                                            $usID = $_GET['UsernameID']; // Use $_GET since you're passing data through the URL
                                            $upName = isset($_POST['updateName']) ? $_POST['updateName'] : '';
                                            $upEmail = isset($_POST['updateEmail']) ? $_POST['updateEmail'] : '';
                                            $upPass = isset($_POST['updatepass']) ? $_POST['updatepass'] : '';

                                            $sqlinsetNewinfo = "UPDATE `patients_user` SET `Name`='$upName',`Email`='$upEmail',`Password`='$upPass' WHERE userId = $usID";
                                            $exestmt = $con -> query($sqlinsetNewinfo);
                                            
                                            echo "<script>alert('Update Done')</script>";
                                        }



                                 $retrieveServices = "SELECT * FROM `patients_user` WHERE Access = 'Receptionist'";
                                $result = $con -> query($retrieveServices);
                                // Loop through the rows of the table to display data
                                while ($row = mysqli_fetch_assoc($result)) {


                                    $recepID = $row['userID'];
                                    $email = $row['Email'];
                                    $name = $row['Name'];
                                    $pass = $row['Password'];

                                    // Displaying the data in a table row
                                    echo '
                    <tr>
                        <td class="hidden-column">'.$recepID.'</td>
                        <td>
                        <form method="post" action="Servicemaintenance.php?UsernameID=' . $recepID . '">
                        <td>
                            <td><input class="form-control" type="text" value="' . $email . '" name="updateEmail"></td>
                           <td><input class="form-control" type="text" value="' . $name . '" name="updateName"></td>
                            <td><input class="form-control" type="text" value="' . $pass . '" name="updatepass"></td>
                            <td>
                                    <button type="submit" class="btn btn-info">Update</button>
                                 </form>
                            </td>
                        </tr>';
                                }
                                ?> 
            </tbody>
        </table>
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://djpsoftwarecdn.azureedge.net/availabilityjs-v1/availability.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
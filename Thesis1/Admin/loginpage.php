<?php
    include_once("connection/connection.php");
    $con = connection();
    session_start();
    
        // Start of LoginFunction //
    
        if(!isset($_SESSION)){
          session_start();
      }
      
      
      if(isset($_POST['login-button'])){
      
          $password = $_POST['password'];
          $email = $_POST['email'];
          
          $sql = "SELECT * FROM patients_user WHERE Email = '$email' AND Password = '$password' AND Active = '1'";
          $patient = $con->query($sql) or die($con->error);
          $row = $patient->fetch_assoc();
          
          $total = $patient->num_rows;
          
          // check if the fields are not empty
          if(empty($email) || empty($password) )
      {
          echo '<script>alert("Please fill out the form")</script>';
      
      }else {
      
          //check if the user is login
          if ($total > 0) {
    
              $_SESSION['UserID'] = $row['userID'];
              $_SESSION['UserLogin'] = $row['Name'];
              $_SESSION['Access'] = $row['Access'];
      
              
      
              if (isset($_SESSION['Access']) && $_SESSION['Access'] == "Administrator") {
                  echo header("Location: index.php");
              }
      
             else if(isset($_SESSION['Access']) && $_SESSION['Access'] =="User" ){
      
                  echo header("Location: patientInterface.php");
              }

              else if(isset($_SESSION['Access']) && $_SESSION['Access'] =="Receptionist"){
                    echo header("Location: receptionistUI.php");
              }
          
          }else {
              echo '<script>alert("Incorrect Username or password")</script>';
          }
      }
    }
      
?>

<!DOCTYPE html>
<html lang="en" style="padding-top: 0px;margin-top: 129px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>DENTALPODADMIN-1</title>
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
    
</head>

<body style="background: #eae7ae;">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-flex">
                    <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/dogs/346105302_795540275463965_7674136203229864425_n%20(1).jpg&quot;);"></div>
                </div>
                <div class="col-lg-6" style="border-top-color: rgb(159,152,117);">
                    <div class="p-5" style="width: 580.5px;">
                        <div class="text-center">
                            <h4 class="text-dark mb-4">Login</h4>
                        </div>
                        <form class="user" method="POST">
                            <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email"></div>
                            <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password"></div>
                            <div class="mb-3">
                                <!-- <div class="custom-control custom-checkbox small">
                                    <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                </div> -->
                            </div><button class="btn btn-primary d-block btn-user w-100" type="submit" style="background: rgb(159,152,117);border-radius: 9px;border-color: rgb(159,152,117);border-top-color: rgb(159,152,117); " name="login-button">Login</button>
                            <hr>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
</body>

</html>
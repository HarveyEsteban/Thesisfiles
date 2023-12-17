<?php
    include_once("connection/connection.php");
    require_once('config.php');
    $redirectTo = "http://localhost:8080/THESIS1/Admin/callback.php";
    $data = ['email'];
    $fullURL = $handler->getLoginUrl($redirectTo, $data);
    $con = connection();
    
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add a custom class to the button */
        .no-hover-effect {
            text-decoration: none !important; /* Remove underline */
            color: #007bff !important; /* Set the text color */
            cursor: auto !important; /* Set the cursor to default */
        }

        /* Style for the button when it's not being hovered */
        .no-hover-effect:hover {
            text-decoration: none !important; /* Remove underline */
            color: #007bff !important; /* Set the text color */
            cursor: auto !important; /* Set the cursor to default */
        }
    </style>
    
</head>

<body style="background: #eae7ae;">
<div class="col">
        <nav class="navbar navbar-light navbar-expand-md py-3" style="background: #ffffff;height: 100px;border-top: 4px solid rgb(159,152,117);border-bottom-color: rgb(159,152,117);margin: -127px 0px 0px;margin-top: -130px;">
            <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><img src="assets/img/Picsart_23-04-17_12-49-06-946.png" width="83" height="83"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier">
                            <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
                            <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
                        </svg></span><span style="padding-left: 28px;font-family: Nunito, sans-serif;font-size: 27px;color: rgb(0,0,0);text-decoration: underline;">THE DENTAL POD</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-2" style="background: #ffffff;border-radius: 13px;width: 2px;padding-left: 0px;margin-left: 259px;padding-bottom: 15px;padding-right: 0px;margin-right: -18px;">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"></li>
                        <li class="nav-item"><a class="nav-link" href="Landingpage.php" style="border-width: 0px;margin-left: 15px;"><strong>Home</strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="ServicesLandingpage.php" style="border-width: 0px;margin-left: 15px;font-weight: bold;">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="About.html" style="border-width: 0px;margin-left: 15px;font-weight: bold;">About</a></li>
                        <li class="nav-item"></li>
                    </ul><a class="btn btn-primary ms-md-2" role="button" href="register.php" style="background: rgb(159,152,117);border-color: rgb(159,152,117);border-top-color: rgb(159,152,117);border-radius: 5px;margin-right: 6px;margin-left: 14px;">Sign Up</a><a class="btn btn-primary ms-md-2" role="button" href="loginpage.php" style="background: rgb(159,152,117);border-color: rgb(159,152,117);border-top-color: rgb(159,152,117);border-radius: 5px;">Login</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-flex">
                    <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/photo_6199380444319955070_y.jpg&quot;);"></div>
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
                            </div><button class="btn btn-primary d-block btn-user w-100" type="submit" style="background: rgb(159,152,117);border-radius: 9px;border-color: rgb(159,152,117);border-top-color: rgb(159,152,117); " name="login-button">Login</button><br>
                            <input type="button" onclick="window.location = '<?php echo $fullURL ?>'" value="Login with Facebook" class="btn btn-primary btn-user btn-block" style="background: #3b5998; border-radius: 9px; border: 1px solid #3b5998;">

                        </form>

                        <form method="post">
                            <div class="text-center">
                                <a href="forgotPass.php" >Forgot password?</a>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
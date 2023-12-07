<?php
      include_once("connection/connection.php");
      include_once("connection/emailValidation.php");
      $con = connection();
      
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
  
    
    
  
  
  
  
    if(isset($_POST['signup-button'])){
        
        $name = $_POST['name']; // store name input to name variable
        $email = $_POST['email']; // store email input to email variable
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $hash = md5( rand(0,1000) ); // generate random hashnumber
        $password = rand(1000,5000); // generate random password 
  
        $checkEmail = isValidEmail($_POST['email']); // pass the value of email to be check in emailValidation.php
  
        
        if(empty($name) || empty($email) || empty($address) || empty($phone) )
        {
            echo '<script>alert("Please fill out the form")</script>';
        
        }else {
  
            if($checkEmail == true){
                
                $sqlverifyemail = "SELECT `email` FROM `patients_user` WHERE email = '$email'";
                $verifyEmail = $con->query($sqlverifyemail);
                
                $row = $verifyEmail->fetch_assoc();
  
                $total = $verifyEmail->num_rows;
            
            
        if ($total > 0) {
            //Display Email already have an account
            echo '<script>alert("Emal already have an account")</script>';
  
        }
        else {
            $sql = "INSERT INTO `patients_user` (`Email`, `Name`, `Address`, `PhoneNumber`, `Password`, `Hash`, `Access`, `activation_timestamp`)
            VALUES ('$email', '$name', '$address', '$phone', '$password', '$hash', 'User', NOW());
            ";
              
                $useradd = $con->query($sql) or die($con->error); //add user to data base
  
  
                // --------------SEND EMAIL FUNCTION
  
                require 'phpmailer/src/Exception.php';
                require 'phpmailer/src/PHPMailer.php';
                require 'phpmailer/src/SMTP.php';
        
                $mail = new PHPMailer(true);    
        
                //Server settings
                $mail->isSMTP();                                     
                $mail->Host = 'smtp.gmail.com';                      
                $mail->SMTPAuth = true;                             
                $mail->Username = 'TheDentalPod@gmail.com';     
                $mail->Password = 'nndcoqvggmmlenhq';             
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                );                         
                $mail->SMTPSecure = 'ssl';                           
                $mail->Port = 465;                                   
        
                //Send Email
                $mail->setFrom('1dummy2020@gmail.com');
                //Recipients
                $mail->addAddress($email);              
                //Content
                
                $to      = $email; // Send email to our user 
                $subject = 'Signup | Verification'; // Give the email a subject 
                $message = ' 
        
                    Thanks for signing up! 
                    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
        
                    ------------------------ 
                    Username: '.$email.' 
                    Password: '.$password.' 
                    ------------------------ 
        
                    Please click this link to activate your account: 
                    http://localhost:8080/THESIS1/Admin/verify.php?email='.$email.'&hash='.$hash.' 
  
        
                    '; // Our message above including the link (Remember to change the port of localhost depns on laptop or computer)
        
                    $mail->Subject = $subject;
                    $mail->Body  = $message;
        
                $mail->send();
  
                echo '<script>alert("Please Check your email for confirmation")</script>';
        }
                
            }else{
                echo '<script>alert("Invalid Email Address")</script>';
            }
  
        
        
        }
    
  
    
    }
?>

<!DOCTYPE html>
<html lang="en" style="background: #eae7ae;padding-top: 9px;margin-top: 59px;height: 639px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - Brand</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body class="bg-gradient-primary" style="color: #a2a07b;background: #eae7ae;margin-top: -20px;">
<div class="col" style="margin: -69px 0px 0px;">
        <nav class="navbar navbar-light navbar-expand-md py-3" style="background: #ffffff;height: 100px;border-top: 4px solid rgb(159,152,117);border-bottom-color: rgb(159,152,117);">
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
                <div class="col-lg-5 d-none d-lg-flex">
                    <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/easy.jpeg.&quot;);"></div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5" style="margin-left: -9px;">
                        <div class="text-center">
                            <h4 class="text-dark mb-4">Sign Up</h4>
                        </div>
                        <form class="user" method="post">
            <input class="form-control form-control-user c1" type="text" id="exampleFirstName-1" placeholder="Full Name" name="name" />
            <div class="mb-3">
                <input class="form-control form-control-user c1" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" name="email" />
            </div>
            <input class="form-control form-control-user c2" type="tel" id="examplePasswordInput" maxlength="11" placeholder="Phone Number" name="phone" />
            <input class="form-control form-control-user c1" type="text" id="exampleRepeatPasswordInput" placeholder="Address" name="address" />
            <button class="btn btn-primary d-block btn-user w-100 c3" type="submit" name="signup-button">Sign Up</bsignuputton>
        </form>
            </div>
                    <div class="text-center"><a class="small" href="Landingpage.php">Home</a></div>
                    <div class="text-center"><a class="small" href="loginpage.php">Already have an account? Login!</a></div>
                </div>
            </div>
        </div>
    </div>
    <script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity = "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity = "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin = "anonymous">
    </script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
</body>

</html>
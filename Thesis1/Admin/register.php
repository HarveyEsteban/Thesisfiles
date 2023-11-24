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
            $sql = "INSERT INTO `patients_user`(`Email`, `Name`, `Address`, `PhoneNumber`, `Password`, `Hash`,`Access`) VALUES ('$email','$name','$address','$phone','$password','$hash', 'User')";
  
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
                $mail->Username = 'asddqqwerasdr@gmail.com';     
                $mail->Password = 'yluqnmartlvrkhkw';             
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
                    http://localhost/THESIS1/Admin/verify.php?email='.$email.'&hash='.$hash.' 
  
        
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
</head>

<body class="bg-gradient-primary" style="color: #a2a07b;background: #eae7ae;margin-top: -20px;">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex">
                    <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/dogs/happy-dental-patient-smiling.jpg.optimal%20(1).jpg&quot;);"></div>
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
            <input class="form-control form-control-user c2" type="tel" id="examplePasswordInput" placeholder="Phone Number" name="phone" />
            <input class="form-control form-control-user c1" type="text" id="exampleRepeatPasswordInput" placeholder="Address" name="address" />
            <button class="btn btn-primary d-block btn-user w-100 c3" type="submit" name="signup-button">Sign Up</bsignuputton>
        </form>
            </div>
                    <div class="text-center"><a class="small" href="Landingpage.html">Home</a></div>
                    <div class="text-center"><a class="small" href="loginpage.php">Already have an account? Login!</a></div>
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
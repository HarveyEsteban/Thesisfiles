<?php
include_once("connection/connection.php");
include_once("connection/emailValidation.php");
$con = connection();
session_start();

    // Start of LoginFunction //

    if(!isset($_SESSION)){
      session_start();
  }
  
  
  if(isset($_POST['login-button'])){
  
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['username'];
      
      $sql = "SELECT * FROM patients_user WHERE Email = '$email' AND Password = '$password' AND Active = '1'";
      $patient = $con->query($sql) or die($con->error);
      $row = $patient->fetch_assoc();
      
      $total = $patient->num_rows;
      
      // check if the fields are not empty
      if(empty($username) || empty($password) )
  {
      echo '<script>alert("Please fill out the form")</script>';
  
  }else {
  
      //check if the user is login
      if ($total > 0) {

        $_SESSION['UserID'] = $row['userID'];
          $_SESSION['UserLogin'] = $row['Name'];
          $_SESSION['Access'] = $row['Access'];
  
          
  
          if (isset($_SESSION['Access']) && $_SESSION['Access'] == "Administrator") {
              echo header("Location: adminPractice.php");
          }
  
         else if(isset($_SESSION['Access']) && $_SESSION['Access'] =="User" ){
  
              echo header("Location: reservationPractice.php");
          }
      
      }else {
          echo '<script>alert("Incorrect Username or password")</script>';
      }
  }
  
      
  }

  // End of LoginFunction //


  // Start of SIGNUP FUNCTION --------------------------------------------------------- // 




  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  





  if(isset($_POST['signup-button'])){
      
      $name = $_POST['name']; // store name input to name variable
      $email = $_POST['email']; // store email input to email variable
      $hash = md5( rand(0,1000) ); // generate random hashnumber
      $password = rand(1000,5000); // generate random password 

      $checkEmail = isValidEmail($_POST['email']); // pass the value of email to be check in emailValidation.php

      
      if(empty($name) || empty($email) )
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
          $sql = "INSERT INTO `patients_user`(`username`, `password`, `access`, `email`, `hash` ) 
          VALUES ('$name','$password','User','$email','$hash')";

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
                  http://localhost/THESIS1/verify.php?email='.$email.'&hash='.$hash.'

      
                  '; // Our message above including the link
      
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
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Dental Pod LandingPage</title>
    <link rel="stylesheet" href="css/nicepage.css" media="screen">
    <link rel="stylesheet" href="css/Dental-Pod-LandingPage.css" media="screen">
    <script class="u-script" type="text/javascript" src="js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.8.2, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">
    
    
    
    
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Site1",
		"sameAs": [
				"https://facebook.com/name",
				"https://twitter.com/name",
				"https://instagram.com/name"
		]
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta name="twitter:site" content="@">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Dental Pod LandingPage">
    <meta name="twitter:description" content="Site1">
    <meta property="og:title" content="Dental Pod LandingPage">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body class="u-body u-overlap u-overlap-contrast u-xl-mode" data-lang="en">
    <section class="u-border-17 u-border-custom-color-16 u-border-no-left u-border-no-right u-clearfix u-image u-shading u-section-1" id="sec-150d" data-image-width="1280" data-image-height="853">
      <div class="u-clearfix u-sheet u-sheet-1">
        <img class="u-image u-image-contain u-image-default u-image-1" src="img/dentalpodlogo-removebg.png" alt="" data-image-width="960" data-image-height="957">
        <a href="#sec-c66c" class="u-btn u-btn-round u-button-style u-custom-font u-dialog-link u-font-roboto u-hover-custom-color-2 u-palette-3-dark-2 u-radius-12 u-btn-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">Sign Up</a>
        <a href="#sec-025f" class="u-border-none u-btn u-btn-round u-button-style u-custom-font u-dialog-link u-font-roboto u-hover-custom-color-2 u-palette-3-dark-2 u-radius-12 u-btn-2">Login</a>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-gradient u-section-2" id="sec-843e">
      <div class="u-clearfix u-sheet u-sheet-1">
        <img class="u-image u-image-round u-radius-23 u-image-1" src="img/338150476_177849951739730_1000137773107443198_n.jpg" alt="" data-image-width="709" data-image-height="371" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-direction="">
      </div>
    </section>
    <section class="u-clearfix u-gradient u-section-3" id="sec-6dde">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-width-xs u-layout-horizontal u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-1">
                <img class="u-expanded-width u-image u-image-round u-radius-26 u-image-1" alt="" data-image-width="2836" data-image-height="1875" src="img/pic.jpg">
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-2">
                <img class="u-expanded-width u-image u-image-round u-radius-26 u-image-2" alt="" data-image-width="2836" data-image-height="1875" src="img/pic1.jpg">
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-3">
                <img class="u-expanded-width u-image u-image-round u-radius-26 u-image-3" alt="" data-image-width="2836" data-image-height="1875" src="img/pic2.jpg">
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-4">
                <img class="u-expanded-width u-image u-image-round u-radius-26 u-image-4" alt="" data-image-width="2836" data-image-height="1875" src="img/pic3.jpg">
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-5">
                <img class="u-expanded-width u-image u-image-round u-radius-26 u-image-5" alt="" data-image-width="2836" data-image-height="1875" src="img/pic4.jpg">
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-6">
                <img class="u-expanded-width u-image u-image-round u-radius-26 u-image-6" alt="" data-image-width="2836" data-image-height="1875" src="img/pic 5.jpg">
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-7">
                <img class="u-expanded-width u-image u-image-round u-radius-26 u-image-7" alt="" data-image-width="2836" data-image-height="1875" src="img/pic6.jpg">
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-valign-bottom-xs u-container-layout-8">
                <img class="u-expanded-width u-image u-image-round u-radius-26 u-image-8" alt="" data-image-width="2836" data-image-height="1875" src="img/pic7.jpg">
              </div>
            </div>
          </div>
          <a class="u-absolute-vcenter u-gallery-nav u-gallery-nav-prev u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-gallery-nav-1" href="#" role="button">
            <span aria-hidden="true">
              <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
            </span>
            <span class="sr-only">
              <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
            </span>
          </a>
          <a class="u-absolute-vcenter u-gallery-nav u-gallery-nav-next u-grey-70 u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-gallery-nav-2" href="#" role="button">
            <span aria-hidden="true">
              <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
            </span>
            <span class="sr-only">
              <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
            </span>
          </a>
        </div>
      </div>
    </section>
    <style class="u-overlap-style">.u-overlap:not(.u-sticky-scroll) .u-header {
background-image: linear-gradient(#d8cfac, #e5e5e5) !important
}</style>
    
    
    
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-386e"><div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-social-icons u-spacing-10 u-social-icons-1">
          <a class="u-social-url" title="facebook" target="_blank" href="https://facebook.com/name"><span class="u-icon u-social-facebook u-social-icon u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-2c30"></use></svg><svg class="u-svg-content" viewBox="0 0 112 112" x="0" y="0" id="svg-2c30"><path fill="currentColor" d="M75.5,28.8H65.4c-1.5,0-4,0.9-4,4.3v9.4h13.9l-1.5,15.8H61.4v45.1H42.8V58.3h-8.8V42.4h8.8V32.2
c0-7.4,3.4-18.8,18.8-18.8h13.8v15.4H75.5z"></path></svg></span>
          </a>
          <a class="u-social-url" title="twitter" target="_blank" href="https://twitter.com/name"><span class="u-icon u-social-icon u-social-twitter u-icon-2"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-6b41"></use></svg><svg class="u-svg-content" viewBox="0 0 112 112" x="0" y="0" id="svg-6b41"><path fill="currentColor" d="M92.2,38.2c0,0.8,0,1.6,0,2.3c0,24.3-18.6,52.4-52.6,52.4c-10.6,0.1-20.2-2.9-28.5-8.2
	c1.4,0.2,2.9,0.2,4.4,0.2c8.7,0,16.7-2.9,23-7.9c-8.1-0.2-14.9-5.5-17.3-12.8c1.1,0.2,2.4,0.2,3.4,0.2c1.6,0,3.3-0.2,4.8-0.7
	c-8.4-1.6-14.9-9.2-14.9-18c0-0.2,0-0.2,0-0.2c2.5,1.4,5.4,2.2,8.4,2.3c-5-3.3-8.3-8.9-8.3-15.4c0-3.4,1-6.5,2.5-9.2
	c9.1,11.1,22.7,18.5,38,19.2c-0.2-1.4-0.4-2.8-0.4-4.3c0.1-10,8.3-18.2,18.5-18.2c5.4,0,10.1,2.2,13.5,5.7c4.3-0.8,8.1-2.3,11.7-4.5
	c-1.4,4.3-4.3,7.9-8.1,10.1c3.7-0.4,7.3-1.4,10.6-2.9C98.9,32.3,95.7,35.5,92.2,38.2z"></path></svg></span>
          </a>
          <a class="u-social-url" title="instagram" target="_blank" href="https://instagram.com/name"><span class="u-icon u-social-icon u-social-instagram u-icon-3"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-c797"></use></svg><svg class="u-svg-content" viewBox="0 0 112 112" x="0" y="0" id="svg-c797"><path fill="currentColor" d="M55.9,32.9c-12.8,0-23.2,10.4-23.2,23.2s10.4,23.2,23.2,23.2s23.2-10.4,23.2-23.2S68.7,32.9,55.9,32.9z
	 M55.9,69.4c-7.4,0-13.3-6-13.3-13.3c-0.1-7.4,6-13.3,13.3-13.3s13.3,6,13.3,13.3C69.3,63.5,63.3,69.4,55.9,69.4z"></path><path fill="#FFFFFF" d="M79.7,26.8c-3,0-5.4,2.5-5.4,5.4s2.5,5.4,5.4,5.4c3,0,5.4-2.5,5.4-5.4S82.7,26.8,79.7,26.8z"></path><path fill="currentColor" d="M78.2,11H33.5C21,11,10.8,21.3,10.8,33.7v44.7c0,12.6,10.2,22.8,22.7,22.8h44.7c12.6,0,22.7-10.2,22.7-22.7
	V33.7C100.8,21.1,90.6,11,78.2,11z M91,78.4c0,7.1-5.8,12.8-12.8,12.8H33.5c-7.1,0-12.8-5.8-12.8-12.8V33.7
	c0-7.1,5.8-12.8,12.8-12.8h44.7c7.1,0,12.8,5.8,12.8,12.8V78.4z"></path></svg></span>
          </a>
        </div>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
        <span>Website Templates</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="" target="_blank">
        <span>Website Builder Software</span>
      </a>. 
    </section>
  <section class="u-align-center u-black u-clearfix u-container-style u-dialog-block u-opacity u-opacity-60 u-valign-middle u-dialog-section-6" id="sec-025f">
      <div class="u-container-style u-dialog u-gradient u-radius-31 u-shape-round u-dialog-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
        <div class="u-container-layout u-container-layout-1">
          <h4 class="u-text u-text-custom-color-3 u-text-1" data-lang-en="LOGIN<span style=&quot;font-weight: 700;&quot;>​</span>">LOGIN<span style="font-weight: 700;"></span>
          </h4>
          <div class="u-form u-form-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">

          <form action="" method = "post">
                <label class="u-custom-font u-font-lato u-label u-text-black u-label-1" data-lang-en="Name">Username</label>
                <input type="text" name="username" class="u-custom-font u-font-arial u-input u-input-rectangle u-radius-19 u-text-black u-input-1" required="" data-lang-en="Enter your Name" placeholder="Enter your Name"><br>
                <label class="u-custom-font u-font-lato u-label u-text-black u-label-2" data-lang-en="Password">Password</label><br>
                <input type="password" name="password" class="u-custom-font u-font-arial u-input u-input-rectangle u-radius-19 u-text-black u-input-2" required="" data-lang-en="Enter your Password" placeholder="Enter your Password"><br><br>
                <input id="login-btn" type="submit" name="login-button" value="Login" class="u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-font-roboto u-radius-17 u-text-grey-80 u-btn-1">

            </form>

            <!-- <form action="" method = "post" style="padding: 10px;">
              <div class="u-form-group u-form-name u-label-top">
                <label class="u-custom-font u-font-lato u-label u-text-black u-label-1" data-lang-en="Name">Username</label>
                <input type="text" id="name-33d9" name="username" class="u-custom-font u-font-arial u-input u-input-rectangle u-radius-19 u-text-black u-input-1" required="" data-lang-en="Enter your Name" placeholder="Enter your Name">
              </div>
              <div class="u-form-email u-form-group u-label-top">
                <label class="u-custom-font u-font-lato u-label u-text-black u-label-2" data-lang-en="Email">Password</label>
                <input type="password" id="email-33d9" name="password" class="u-custom-font u-font-arial u-input u-input-rectangle u-radius-19 u-text-black u-input-2" required="" data-lang-en="Enter a valid email address" placeholder="Enter a valid email address">
              </div>
              <div class="u-align-center u-form-group u-form-submit u-label-top">
                <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-custom-font u-font-roboto u-radius-17 u-text-grey-80 u-btn-1" data-lang-en="{&quot;content&quot;:&quot;Submit&quot;,&quot;href&quot;:&quot;#&quot;}" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">Login</a>
                <input type="submit" value="submit" name="login-button" class="u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-custom-font u-font-roboto u-radius-17 u-text-grey-80 u-btn-1" data-lang-en="{&quot;content&quot;:&quot;Submit&quot;,&quot;href&quot;:&quot;#&quot;}" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
              </div>
              <div class="u-form-send-message u-form-send-success" data-lang-en="
            Thank you! Your message has been sent.
        "> Thank you! Your message has been sent. </div>
              <div class="u-form-send-error u-form-send-message" data-lang-en="
            Unable to send your message. Please fix errors then try again.
        "> Unable to send your message. Please fix errors then try again. </div>
              <input type="hidden" value="" name="recaptchaResponse">
              <input type="hidden" name="formServices" value="abc68fd9b66f962af5ac13f91de30405">
            </form> -->
          </div>
        </div><button class="u-dialog-close-button u-file-icon u-icon u-text-grey-40 u-icon-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction=""><img src="img/148777-270c2e6f.png" alt=""></button>
      </div>
    </section><style>.u-dialog-section-6 .u-dialog-1 {
  background-image: linear-gradient(#d8cfac, #f2f2f2);
  width: 587px;
  height: auto;
  min-height: 446px;
  margin: 60px auto;
}

.u-dialog-section-6 .u-container-layout-1 {
  padding: 27px 5px 10px 10px;
}

.u-dialog-section-6 .u-text-1 {
  font-weight: 700;
  text-transform: uppercase;
  margin: 51px 252px 0 247px;
}

.u-dialog-section-6 .u-form-1 {
  height: 232px;
  background-image: none;
  margin: 21px 155px 0 150px;
}

.u-dialog-section-6 .u-label-1 {
  font-weight: normal;
  font-style: italic;
  letter-spacing: 1px;
  font-size: 0.875rem;
}

.u-dialog-section-6 .u-input-1 {
  font-size: 0.75rem;
  box-shadow: 5px 5px 20px 0 rgba(0,0,0,0.4);
  font-weight: 700;
  background-image: none;
  height: 41px;
  letter-spacing: 0px;
}

.u-dialog-section-6 .u-label-2 {
  font-weight: normal;
  font-style: italic;
  letter-spacing: 1px;
  font-size: 0.875rem;
}

.u-dialog-section-6 .u-input-2 {
  font-size: 0.75rem;
  box-shadow: 5px 5px 20px 0 rgba(0,0,0,0.4);
  font-weight: 700;
  background-image: none;
  height: 41px;
  letter-spacing: 0px;
}

.u-dialog-section-6 .u-btn-1 {
  text-transform: uppercase;
  background-image: none;
  font-weight: 700;
  padding: 7px 31px 8px 29px;
}

.u-dialog-section-6 .u-icon-1 {
  width: 20px;
  height: 20px;
  left: auto;
  top: 14px;
  position: absolute;
  right: 13px;
  background-image: none;
  padding: 0;
}

@media (max-width: 1199px) {
  .u-dialog-section-6 .u-text-1 {
    width: 89px;
    margin-left: 247px;
    margin-right: 252px;
  }

  .u-dialog-section-6 .u-form-1 {
    width: 300px;
  }
}

@media (max-width: 767px) {
  .u-dialog-section-6 .u-dialog-1 {
    width: 540px;
  }

  .u-dialog-section-6 .u-text-1 {
    margin-left: 224px;
    margin-right: 229px;
  }

  .u-dialog-section-6 .u-form-1 {
    margin-left: 127px;
    margin-right: 132px;
  }
}

@media (max-width: 575px) {
  .u-dialog-section-6 .u-dialog-1 {
    width: 340px;
  }

  .u-dialog-section-6 .u-text-1 {
    margin-left: 124px;
    margin-right: 129px;
  }

  .u-dialog-section-6 .u-form-1 {
    margin-left: 27px;
    margin-right: 32px;
  }
}</style><section class="u-black u-clearfix u-container-style u-dialog-block u-opacity u-opacity-70 u-valign-middle u-dialog-section-7" id="sec-c66c">
      <div class="u-container-style u-dialog u-gradient u-radius-31 u-shape-round u-dialog-1">
        <div class="u-container-layout u-container-layout-1">
          <h4 class="u-text u-text-custom-color-2 u-text-default u-text-1" data-lang-en="Sign Up">Sign Up</h4>
          <div class="u-form u-form-1">

          <form action="" method = "post">
                    <label class="u-custom-font u-font-lato u-label u-text-black u-label-2" data-lang-en="Email" for="userName">Enter Name</label><br>
                        <input class="u-custom-font u-font-arial u-input u-input-rectangle u-radius-19 u-text-black u-input-1" required="" data-lang-en="Enter your Name" placeholder="Enter your Name" type="text" name="name" id="fullname">

                        <label class="u-custom-font u-font-lato u-label u-text-black u-label-2" data-lang-en="Email" for="email">Enter Email</label>
                        <input class="u-custom-font u-font-arial u-input u-input-rectangle u-radius-19 u-text-black u-input-2" required="" data-lang-en="Enter a valid email address" placeholder="Enter a valid email address" type="text" name="email" id="emailadd">

                        <input id="signin-btn" type="submit" name="signup-button" value="Signup" class="u-btn u-btn-round u-button-style u-custom-color-1 u-custom-font u-font-roboto u-radius-17 u-text-grey-80 u-btn-1">
                    </form> 


            <!-- <form action="https://forms.nicepagesrv.com/v2/form/process" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" source="email" name="form" style="padding: 10px;">
              <div class="u-form-group u-form-name u-label-top">
                <label class="u-custom-font u-font-lato u-label u-text-black u-label-1" data-lang-en="Name">Username</label>
                <input type="text" id="name-3fd7" name="name" class="u-custom-font u-font-arial u-input u-input-rectangle u-radius-19 u-text-black u-input-1" required="" data-lang-en="Enter your Name" placeholder="Enter your Name">
              </div>
              <div class="u-form-email u-form-group u-label-top">
                <label class="u-custom-font u-font-lato u-label u-text-black u-label-2" data-lang-en="Email">Email</label>
                <input type="email" id="email-3fd7" name="email" class="u-custom-font u-font-arial u-input u-input-rectangle u-radius-19 u-text-black u-input-2" required="" data-lang-en="Enter a valid email address" placeholder="Enter a valid email address">
              </div>
              <div class="u-align-center u-form-group u-form-submit u-label-top">
                <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-custom-color-1 u-custom-font u-font-roboto u-radius-17 u-text-grey-80 u-btn-1" data-lang-en="{&quot;content&quot;:&quot;Submit&quot;,&quot;href&quot;:&quot;#&quot;}" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction=""> register</a>
                <input type="submit" value="submit" class="u-form-control-hidden">
              </div>
              <div class="u-form-send-message u-form-send-success" data-lang-en="
            Thank you! Your message has been sent.
        "> Thank you! Your message has been sent. </div>
              <div class="u-form-send-error u-form-send-message" data-lang-en="
            Unable to send your message. Please fix errors then try again.
        "> Unable to send your message. Please fix errors then try again. </div>
              <input type="hidden" value="" name="recaptchaResponse">
              <input type="hidden" name="formServices" value="abc68fd9b66f962af5ac13f91de30405">
            </form> -->
          </div>
        </div><button class="u-dialog-close-button u-icon u-text-grey-40 u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 16 16" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-efe9"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 16 16" x="0px" y="0px" id="svg-efe9"><rect x="7" y="0" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.3138 8.0002)" width="2" height="16"></rect><rect x="0" y="7" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.3138 8.0002)" width="16" height="2"></rect></svg></button>
      </div>
    </section><style>.u-dialog-section-7 .u-dialog-1 {
  width: 587px;
  height: auto;
  background-image: linear-gradient(#d8cfac, #f2f2f2);
  min-height: 458px;
  margin: 60px auto;
}

.u-dialog-section-7 .u-container-layout-1 {
  padding: 10px 10px 30px;
}

.u-dialog-section-7 .u-text-1 {
  font-weight: 700;
  text-transform: uppercase;
  margin: 70px auto 0;
}

.u-dialog-section-7 .u-form-1 {
  height: 232px;
  width: 267px;
  margin: 5px auto 0;
}

.u-dialog-section-7 .u-label-1 {
  font-weight: normal;
  font-style: italic;
  letter-spacing: 1px;
  font-size: 0.875rem;
}

.u-dialog-section-7 .u-input-1 {
  font-size: 0.75rem;
  box-shadow: 5px 5px 20px 0 rgba(0,0,0,0.4);
  font-weight: 700;
  background-image: none;
  height: 41px;
  letter-spacing: 0px;
}

.u-dialog-section-7 .u-label-2 {
  font-weight: normal;
  font-style: italic;
  letter-spacing: 1px;
  font-size: 0.875rem;
}

.u-dialog-section-7 .u-input-2 {
  font-size: 0.75rem;
  box-shadow: 5px 5px 20px 0 rgba(0,0,0,0.4);
  font-weight: 700;
  background-image: none;
  height: 41px;
  letter-spacing: 0px;
}

.u-dialog-section-7 .u-btn-1 {
  text-transform: uppercase;
  background-image: none;
  padding: 7px 31px 8px 29px;
}

.u-dialog-section-7 .u-icon-1 {
  width: 20px;
  height: 20px;
}

@media (max-width: 1199px) {
  .u-dialog-section-7 .u-btn-1 {
    font-weight: normal;
  }
}

@media (max-width: 767px) {
  .u-dialog-section-7 .u-dialog-1 {
    width: 540px;
  }
}

@media (max-width: 575px) {
  .u-dialog-section-7 .u-dialog-1 {
    width: 340px;
  }
}</style>
</body></html>
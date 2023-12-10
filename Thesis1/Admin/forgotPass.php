<?php
include_once("connection/connection.php");
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Asia/Manila');
$con = connection();
session_start();

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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Add a custom class to the button */


        .forgot-password-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .forgot-password-container h2 {
            color: #333;
        }

        .forgot-password-container button {
            background: #159752;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }

.forgot-password-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
    margin: auto; /* Add this line to center the container horizontally */
    margin-top: 50px; /* Adjust this value based on your design */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
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

						<?php

						function sendEmailVerificationCode($emailGet, $conNumber,$expStamp){
								global $con;
								 $mail = new PHPMailer(true);

							    // Server settings
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
							        ),
							    );
							    $mail->SMTPSecure = 'ssl';
							    $mail->Port = 465;

							    	$sqlInsertConfirmation = "UPDATE `patients_user` SET `ForgotPass`='$conNumber',`forgot_expiration`=FROM_UNIXTIME($expStamp) WHERE Email = '$emailGet'";
							    	$exeInsert = $con->query($sqlInsertConfirmation);


							        $mail->setFrom('1dummy2020@gmail.com');
								    $subject = 'Verification | Code';
								    $message = "The verification code is: $conNumber
								    Reminder That you only have 30 minutes before the code Expires";
								    $mail->Subject = $subject;
								    $mail->Body = $message;
								    $mail->addAddress($emailGet);
									$mail->send();


						}

						function ChangePass($emailGet, $pass)
						{
							global $con;

  							$sqlPass = "UPDATE `patients_user` SET `Password`='$pass' WHERE Email = '$emailGet'";
  							$exe = $con -> query($sqlPass);

						}


						// Initialize a variable to hold the dynamic content

						$newContent = '';

						if(isset($_POST['New-pass']) && isset($_POST['Con-pass']))
						{
							$emailGet = $_SESSION['emailGet'];
							$newPass = $_POST['New-pass'];
							$conPass = $_POST['Con-pass'];

							if(checkPass($newPass))
							{
								if($newPass == $conPass){
									ChangePass($emailGet, $newPass);
									$newContent = '
									        <!-- Add an ID to the div -->
									        <div id="dynamicContentContainer" class="forgot-password-container">
									         <h2>Password Change</h2>
									         	<h2>Password has been successfully reset</h2>
									         	<br>
									        </div>';
								}
								else{
								$newContent = '
									        <!-- Add an ID to the div -->
									        <div id="dynamicContentContainer" class="forgot-password-container">
									         <h2>Password Does not match</h2>
									         	<p>Please Enter you new password</p>
									            <form method="POST">
									                <input type="text" name="New-pass" id="New-pass" placeholder="Enter New Password" required>
									                <br>
									                 <input type="text" name="Con-pass" id="Con-pass" placeholder="Re-enter your Password" required>
									                 <br>
									                <button type="submit">Submit</button>
									            </form>
									        </div>';

								}
							}
							else{
							 $newContent = '
									        <!-- Add an ID to the div -->
									        <div id="dynamicContentContainer" class="forgot-password-container">
									         <h4>The Password Must contain letters and numbers and minimum of 8</h4>
									         	<p>Please Enter you new password</p>
									            <form method="POST">
									                <input type="text" name="New-pass" id="New-pass" placeholder="Enter New Password" required>
									                <br>
									                 <input type="text" name="Con-pass" id="Con-pass" placeholder="Re-enter your Password" required>
									                 <br>
									                <button type="submit">Submit</button>
									            </form>
									        </div>';							}

						}

						elseif(isset($_POST['btn-resend'])){
								$emailGet = $_SESSION['emailGet'];
								$ConfirmationNumber = rand();
						    	$expirationTimestamp = time() + 30 * 60; // 24 * 60 *  

								sendEmailVerificationCode($emailGet, $ConfirmationNumber,$expirationTimestamp);

							$newContent = '
									        <!-- Add an ID to the div -->
									        <div id="dynamicContentContainer" class="forgot-password-container">
									         <h2>Verification</h2>
									         	<p>Please Enter the code that is sent to your Email</p>
									            <form method="POST">
									                <input type="text" name="veryfy-Code" id="veryfy-Code" placeholder="Enter Verification Code" required>
									                <br>
									                <button type="submit">Submit</button>
									            </form>
									        </div>';




						}

						elseif(isset($_POST['veryfy-Code']))
						{
							$verificationCode = $_POST['veryfy-Code'];

							$sqlgetVeri = "SELECT * FROM patients_user WHERE ForgotPass = '$verificationCode'";
							$exeSmt = $con->query($sqlgetVeri);
							$row = $exeSmt -> fetch_assoc();
							$total = $exeSmt->num_rows;

							if($total > 0)
							{
								$expirationStamp = strtotime($row['forgot_expiration']);
								if(time() < $expirationStamp)
								{
									 $newContent = '
									        <!-- Add an ID to the div -->
									        <div id="dynamicContentContainer" class="forgot-password-container">
									         <h2>Verification Confirm</h2>
									         	<p>Please Enter you new password</p>
									            <form method="POST">
									                <input type="text" name="New-pass" id="New-pass" placeholder="Enter New Password" required>
									                <br>
									                 <input type="text" name="Con-pass" id="Con-pass" placeholder="Re-enter your Password" required>
									                 <br>
									                <button type="submit">Submit</button>
									            </form>
									        </div>';
								}
								else
								{
									$newContent = '
									        <!-- Add an ID to the div -->
									        <div id="dynamicContentContainer" class="forgot-password-container">
									         <h2>Expired</h2>
									         	<h2>Your Code has Expired</h2>
									         	<br>
									         	<form method="post">
									         	<button name="btn-resend" type="submit">Resend</button>
									         	</form>
									         	
									        </div>';
								}

							}
							else{
								echo "<script>alert('Invalid Code')";
							}
						}

						elseif (isset($_POST['emailReset'])) {
						    $emailReset = $_POST['emailReset'];


						    $selectUser = "SELECT *	FROM patients_user WHERE Email = '$emailReset' AND Active = '1'";
						    $exe = $con->query($selectUser);
						    $row = $exe->fetch_assoc();
						    $total = $exe -> num_rows;

						    if($total > 0)
						    {
						    	
						    	$_SESSION['emailGet'] = $row['Email'];
						    	$emailGet = $_SESSION['emailGet'];
						    	$ConfirmationNumber = rand();
						    	$expirationTimestamp = time() + 30 * 60; // 24 * 60 * 30 * 

						    	sendEmailVerificationCode($emailGet,$ConfirmationNumber,$expirationTimestamp);

									    $newContent = '
									        <!-- Add an ID to the div -->
									        <div id="dynamicContentContainer" class="forgot-password-container">
									         <h2>Verification</h2>
									         	<p>Please Enter the code that is sent to your Email</p>
									            <form method="POST">
									                <input type="text" name="veryfy-Code" id="veryfy-Code" placeholder="Enter Verification Code" required>
									                <br>
									                <button type="submit">Submit</button>
									            </form>
									        </div>';
									    }else
									    {
									    	$newContent = '
									        <!-- Add an ID to the div -->
									        <div id="dynamicContentContainer" class="forgot-password-container">
									         <h2>Invalid</h2>
									         	<p>No account found</p>
									            <form method="POST">
									                <br>
									                <button>Enter Email</button>
									            </form>
									        </div>';
									    }

						    
						   
						} else {
						    // If the form has not been submitted, render the default form
						    $newContent = '
						        <!-- Add an ID to the div -->
						        <div id="dynamicContentContainer" class="forgot-password-container">
						         <h2>Forgot Password?</h2>
						         	<p>Enter your email address to reset your password.</p>
						            <form method="POST">
						                <input type="email" name="emailReset" id="emailReset" placeholder="Your Email" required>
						                <br>
						                <button type="submit">Reset Password</button>
						            </form>

						            <p><a href="loginpage.php">Back to Login</a></p>
						        </div>';
						}

						// Print the new content directly into the HTML
						echo $newContent;
						?>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
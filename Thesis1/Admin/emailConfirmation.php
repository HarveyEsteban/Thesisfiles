<?php
include_once("connection/connection.php");
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$con = connection();
date_default_timezone_set('Asia/Manila');

$currentDate = date('Y-m-d');
$reminderDate = date('Y-m-d', strtotime($currentDate . ' + 3 days'));

$sql = "SELECT DISTINCT patients_user.Email,patients_user.Name
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE date = '$reminderDate'";
$exe = $con->query($sql);

while ($row = $exe->fetch_assoc()) {
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

    $email = $row['Email'];
    $nameUser = $row['Name'];

    // Generate a unique hash code
    $hashCode = hash('sha256', uniqid());
    $expirationTimestamp = time() +60; // 24 * 60 * 

    // Store hash code and timestamp in the database
    $insertSql = "INSERT INTO confirmation_data (email, hash_code, timestamp, expiration_timestamp) VALUES ('$email', '$hashCode', NOW(), FROM_UNIXTIME($expirationTimestamp))";
    $con->query($insertSql);

    // Send Email
    $mail->setFrom('1dummy2020@gmail.com');
    $subject = 'Reservation | Confirmation';
    $message = "
        Dear $nameUser,
        
        Please Confirm your reservation through the link below, You will have 24hours to do so.
        If the reservation is not confirm it will automatically be canceled


        Thank you for understanding Have a good day ahead $nameUser


        Please click this link to activate your account:
        http://localhost:8080/THESIS1/Admin/confirmation.php?email=$email&hashCode=$hashCode 

    ";
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->addAddress($email);


    if (!$mail->send()) {
        echo 'Error sending email to ' . $email . ': ' . $mail->ErrorInfo . '<br>';
    } else {
        echo 'Email sent to ' . $email . '<br>';
    }

    $mail->clearAddresses();
}

// Close the database connection
$con->close();
?>

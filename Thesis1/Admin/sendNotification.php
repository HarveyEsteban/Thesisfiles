<?php
include_once("connection/connection.php");
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$con = connection();

$currentDate = date('Y-m-d');
$reminderDate = date('Y-m-d', strtotime($currentDate . ' + 2 days'));





$sql = "SELECT patients_user.Email,patients_user.Name,bookinglog.serviceName,bookinglog.date,bookinglog.timeslot,bookinglog.resID
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
    $mail->Username = 'asddqqwerasdr@gmail.com';
    $mail->Password = 'yluqnmartlvrkhkw';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ),
    );
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $resID = $row['resID'];
    $email = $row['Email'];
    $nameUser = $row['Name'];
    $serviceName =$row['serviceName'];
    $bookDate = $row['date'];
    $ts = $row['timeslot'];

    // Send Email
    $mail->setFrom('1dummy2020@gmail.com');
    $subject = 'Reminder | Reservation';
    $message = "
        Dear $nameUser,
        
        This is a reminder that you have an up coming reservation on $bookDate at $ts
        for $serviceName please be at The Dental Pod early so that you would not miss
        your reservation. 

        This is an automated email please dont reply, have a good day ahead $nameUser
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

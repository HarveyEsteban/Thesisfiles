<?php

include_once("connection/connection.php");
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function SendNotif()
{
$con = connection();

$currentDate = date('Y-m-d');
$reminderDate = date('Y-m-d', strtotime($currentDate . ' + 1 days'));


$sql = "SELECT patients_user.Email,patients_user.Name,bookinglog.serviceName,bookinglog.date,bookinglog.timeslot,bookinglog.resID
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE date = '$reminderDate' AND status = 'Pending'";
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
        // echo 'Email sent to ' . $email . '<br>';
    }

    $mail->clearAddresses();
}

}

function AutoCancel()
{
    $con = connection();
    $stmtGetEmails = "SELECT * FROM `confirmation_data` WHERE expiration_timestamp < CURRENT_TIMESTAMP AND confirmed = '0'";
    $exestmt = $con->query($stmtGetEmails);
    $total = $exestmt->num_rows;
    
    if($total > 0)
    {
        while($row = $exestmt->fetch_assoc())
        {
            $resIDCan = $row['resID'];
            $cancelstmt = "UPDATE `bookinglog` SET `status`='Cancel' WHERE resID = '$resIDCan'";
            $executestmt = $con -> query($cancelstmt);
        }
    }
}

function runOncePerDay()
{
    // Set the filename for storing the last execution timestamp
    $filename = 'sss.txt';

    // Check if the file exists
    if (file_exists($filename)) {
        // Read the last execution timestamp from the file
        $lastExecutionTimestamp = intval(file_get_contents($filename));
    } else {
        // If the file doesn't exist, set an initial timestamp to ensure the function runs on the first execution
        $lastExecutionTimestamp = 0;
    }

    // Get the current timestamp
    $currentTimestamp = time();

    // Check if a day has passed since the last execution
    if ($currentTimestamp - $lastExecutionTimestamp >= 24 * 60 * 60) {
        // Call the provided function
        SendEmailConfirmation();
        AutoCancel();
        SendNotif();
        // Update the last execution timestamp in the file
        file_put_contents($filename, $currentTimestamp);

        // echo "Function executed successfully!";
    } else {
        // echo "Function already executed today.";
    }
}


function SendEmailConfirmation()
{
    $con = connection();
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');
    $reminderDate = date('Y-m-d', strtotime($currentDate . ' + 3 days'));

    $sql = "SELECT DISTINCT patients_user.Email,patients_user.Name,bookinglog.resID
            FROM bookinglog
            INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
            WHERE date = '$reminderDate' AND admin_remarks = 'None'";
    $exe = $con->query($sql);

    // Check if there are eligible users for email confirmation
    if ($exe->num_rows > 0) {
        // Check if the function has already been executed today
        $alreadyExecuted = false;

        // Iterate through the results
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
            $resID = $row['resID'];

            // Generate a unique hash code
            $hashCode = hash('sha256', uniqid());
            $expirationTimestamp = time() + 24 * 60 * 60; // 

            // Store hash code and timestamp in the database
            $insertSql = "INSERT INTO confirmation_data (email, hash_code, timestamp, expiration_timestamp, resID) VALUES ('$email', '$hashCode', NOW(), FROM_UNIXTIME($expirationTimestamp), '$resID')";
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
                http://localhost/THESIS1/Admin/confirmation.php?email=$email&hashCode=$hashCode 
        
            ";
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->addAddress($email);

            // Try to send the email
            if (!$mail->send()) {
                echo 'Error sending email to ' . $email . ': ' . $mail->ErrorInfo . '<br>';
            } else {
                // echo 'Email sent to ' . $email . '<br>';
                // Set the flag to indicate that the function has been executed
                $alreadyExecuted = true;
            }

            $mail->clearAddresses();
        }

    } else {
        // Display a message if there are no eligible users
        echo 'No eligible users for email confirmation today.<br>';
    }

    // Close the database connection
    $con->close();
}

// Call the wrapper function with your original function

?>
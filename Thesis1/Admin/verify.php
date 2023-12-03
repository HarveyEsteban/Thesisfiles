<?php

include_once("connection/connection.php");

$con = connection();


    // if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    //     // Verify data 

    //     $email = $_GET['email'];
    //     $hash = $_GET['hash'];

    //    $sqlverify ="SELECT `email`, `hash`, `active` FROM `patients_user` WHERE Email ='$email' AND Hash = '$hash' AND active='0'";
    
    //    $verify = $con->query($sqlverify);

    //    $row = $verify->fetch_assoc();

    //      $total = $verify->num_rows;

    //   if($total > 0){
    //     // We have a match, activate the account 
    //     $sqlactivate = "UPDATE `patients_user` SET `active`='1'WHERE Email ='$email' AND Hash = '$hash'";
    //     $activate = $con->query($sqlactivate);
    //     echo '<div class="statusmsg">Your account has been activated, you can now login</div>';

    // }else{
    //     // No match -> invalid url or account has already been activated. 
    //     echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';


    // }



    // }else{
    //     // Invalid approach 
    // }


$hashCode = $_GET['hashCode'] ?? '';
$email = $_GET['email'] ?? '';

if ($hashCode) {
    // Retrieve confirmation data from the database
    $selectSql = "SELECT * FROM confirmation_data WHERE hash_code = '$hashCode'";
    $result = $con->query($selectSql);

    if ($result->num_rows > 0) {
        $confirmationData = $result->fetch_assoc();

        // Check if the link has expired
        $expirationTimestamp = strtotime($confirmationData['expiration_timestamp']);
        if (time() < $expirationTimestamp) {

           $sqlConfirm = " UPDATE `confirmation_data` SET `confirmed`='1' WHERE hash_code = '$hashCode'";
           $exeConfirm = $con->query($sqlConfirm);
            echo 'Verification successful!';


        } else {

            $sqlCheck = "SELECT * FROM `confirmation_data` WHERE confirmed = '0'";
            $execheck = $con->query($sqlCheck);

            if($execheck->num_rows > 0)
            {
            $sqlstmt = "UPDATE `bookinglog` SET `status`='Pending' WHERE Email = '$email'";
            $con->query($sqlstmt);
            echo 'Verification link has expired.';
            }

            
        }
    } else {
        echo 'Invalid verification link.';
    }
} else {
    echo 'No Hash Get';
}



?>
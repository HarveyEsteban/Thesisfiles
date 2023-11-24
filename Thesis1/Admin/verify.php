<?php

include_once("connection/connection.php");

$con = connection();


    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
        // Verify data 

        $email = $_GET['email'];
        $hash = $_GET['hash'];

       $sqlverify ="SELECT `email`, `hash`, `active` FROM `patients_user` WHERE Email ='$email' AND Hash = '$hash' AND active='0'";
    
       $verify = $con->query($sqlverify);

       $row = $verify->fetch_assoc();

         $total = $verify->num_rows;

      if($total > 0){
        // We have a match, activate the account 
        $sqlactivate = "UPDATE `patients_user` SET `active`='1'WHERE Email ='$email' AND Hash = '$hash'";
        $activate = $con->query($sqlactivate);
        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';

    }else{
        // No match -> invalid url or account has already been activated. 
        echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';


    }



    }else{
        // Invalid approach 
    }
?>
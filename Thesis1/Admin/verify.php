<?php
// Set the timezone to UTC
date_default_timezone_set('Asia/Manila');

include_once("connection/connection.php");

$con = connection();

if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])) {
    // Verify data
    $email = $_GET['email'];
    $hash = $_GET['hash'];

    $sqlverify = "SELECT `email`, `hash`, `active`, `activation_timestamp` FROM `patients_user` WHERE Email ='$email' AND Hash = '$hash' AND active='0'";

    $verify = $con->query($sqlverify);

    $row = $verify->fetch_assoc();
    $total = $verify->num_rows;

    if ($total > 0) {
        // Check if the activation link is still valid (e.g., within 24 hours)
        $activationTimestamp = strtotime($row['activation_timestamp']);
        $currentTimestamp = time();
        $expirationPeriod = 30 * 60; // 24 hours in seconds

        if ($currentTimestamp <= $activationTimestamp + $expirationPeriod) {
            // We have a match, activate the account
            $sqlactivate = "UPDATE `patients_user` SET `active`='1' WHERE Email ='$email' AND Hash = '$hash'";
            $activate = $con->query($sqlactivate);
            echo '<div class="alert alert-success" role="alert">
                    Your Account has been activated. You can now login using your credentials.
                    <br>
                    <a class="btn btn-primary btn-lg" href="loginpage.php" role="button">Login</a>
                  </div>';
        } else {
            // Activation link has expired
            echo '<div class="alert alert-danger" role="alert">
                    Your activation link has expired.
                  </div>';
        }
    } else {
        // No match -> invalid URL or account has already been activated.
        echo '<div class="alert alert-danger" role="alert">
                Your Account has not been activated.
              </div>';
    }
} else {
    // Invalid approach
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation</title>
    <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity = "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin = "anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
    .alert{
        text-align: center;
    }
</style>
</head>
<body>
 <script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity = "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity = "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin = "anonymous">
    </script>
</body>
</html>
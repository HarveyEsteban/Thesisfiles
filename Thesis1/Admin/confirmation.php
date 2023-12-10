<?php

include_once("connection/connection.php");
date_default_timezone_set('Asia/Manila');
$con = connection();


 
if (isset($_GET['hashCode']) && isset($_GET['email'])) {
    $hashCode = $_GET['hashCode'];
    $email = $_GET['email'];

    // Retrieve confirmation data from the database
    $selectSql = "SELECT * FROM confirmation_data WHERE hash_code = ?";
    $smtp = $con->prepare($selectSql);
    $smtp->bind_param("s", $hashCode);
    $smtp->execute();
    $result = $smtp->get_result();
    $total = $result->num_rows;

    if ($total > 0) {
        $confirmationData = $result->fetch_assoc();
                $currentTimestamp = time();


        // Check if the link has expired
        $expirationTimestamp = strtotime($confirmationData['expiration_timestamp']);
        if (time() < $expirationTimestamp) {

           $sqlConfirm = " UPDATE `confirmation_data` SET `confirmed`='1' WHERE hash_code = '$hashCode'";
           $exeConfirm = $con->query($sqlConfirm);
            echo '<div class="alert alert-success" role="alert">
                  Verification Successful You can now close this tab Thank You!
                </div>';


        } else {

                        echo '<div class="alert alert-danger" role="alert">
                        Sorry your reservation has been canceld due to not being able to confirm within the given time
                        </div>';
        }
    } else {
                                echo '<div class="alert alert-danger" role="alert">
                                invalid Verification Link
                                </div>';
    }
} else {
    echo 'No Hash Get';
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
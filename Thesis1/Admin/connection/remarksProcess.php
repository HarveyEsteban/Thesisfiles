<?php

include_once("connection.php");
$con = connection();
// Check if the input value is set in the POST request
if(isset($_POST['inputValue']) && isset($_POST['resID'])) {
    // Get the input value from the POST data
    $inputValue = $_POST['inputValue'];
    $resID = $_POST['resID'];

    // Process the input value (you can perform any processing here)
    $processedValue = $inputValue;
    $porcessID = $resID;

    $sql = "UPDATE `bookinglog` SET `remarks`='$processedValue' WHERE resID =  $porcessID";
    $exestmt = $con->query($sql);

    echo "sucessfully inserted remarks";

}
?>
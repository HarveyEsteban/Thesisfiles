<?php

include_once("connection/connection.php");
$con = connection();
// Check if the input value is set in the POST request
if(isset($_POST['inputValue'])) {
    // Get the input value from the POST data
    $inputValue = $_POST['inputValue'];

    // Process the input value (you can perform any processing here)
    $processedValue = $inputValue;

    $sql = "UPDATE `reservation` SET `remarks`='$processedValue' WHERE userID = 1 ";
    $exestmt = $con->query($sql);

    echo "sucessfully inserted remarks";

}
?>
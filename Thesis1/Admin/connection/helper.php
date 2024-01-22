<?php
include_once('connection.php');
date_default_timezone_set('Asia/Manila');




function PastTimeslotCancel() {
    $con = connection();
    $todaysDate = date("Y-m-d");
    $isAnyTimeslotInPast = false;

    $selectPastslot = "SELECT resID, timeslot, date FROM `bookinglog` WHERE date = '$todaysDate'";
    $exe = $con->query($selectPastslot);

    while ($row = $exe->fetch_assoc()) {
        $resId = $row['resID'];
        $timeslot = $row['timeslot'];
        $date = $row['date'];

        $timezone = new DateTimeZone('Asia/Manila');
        $currentDateTime = new DateTime('now', $timezone);
        $timeslotDateTime = DateTime::createFromFormat('Y-m-d h:i A', $date . ' ' . explode(' - ', $timeslot)[0], $timezone);

        // Check if the timeslot is in the past
        if ($timeslotDateTime < $currentDateTime) {
            // Perform the cancellation for the current $resId
            $cancelStmt = "UPDATE `bookinglog` SET `status`='Cancel' WHERE resID = '$resId'";
            $con->query($cancelStmt);

            // Set the flag to indicate that at least one timeslot is in the past
            $isAnyTimeslotInPast = true;
        }
    }

    // Return true if any timeslot is in the past, otherwise, return false
    return $isAnyTimeslotInPast;
}


?>

<?php

include_once("connection/connection.php");
$con = connection();
date_default_timezone_set('Asia/Manila');

$currentDate = date('Y-m-d');
$reminderDate = date('Y-m-d', strtotime($currentDate . ' + 3 days'));

echo $reminderDate;

$sql = "SELECT DISTINCT patients_user.Email, bookinglog.resID
        FROM bookinglog
        INNER JOIN patients_user ON bookinglog.userID = patients_user.userID
        WHERE date = '$reminderDate'";
$exe = $con->query($sql);

if ($exe) {
    while ($row = $exe->fetch_assoc()) {
        $email = $row['Email'];
        $resID = $row['resID'];

        echo $email;

        // Use prepared statement to check for unconfirmed bookings
        $stmtCheckIfConfirm = $con->prepare("SELECT * FROM `confirmation_data` WHERE email = ? AND confirmed = '0'");
        $stmtCheckIfConfirm->bind_param("s", $email);
        $stmtCheckIfConfirm->execute();
        $resultCheckIfConfirm = $stmtCheckIfConfirm->get_result();
        $total = $resultCheckIfConfirm->num_rows;

        if ($total > 0) {
            // Use prepared statement to update booking status
            $stmtUpdate = $con->prepare("UPDATE `bookinglog` SET `status`='Cancel' WHERE resID = ?");
            $stmtUpdate->bind_param("i", $resID);
            $stmtUpdate->execute();

            echo "Reservation has been canceled";
        }
    }
} else {
    echo "Error executing the query: " . $con->error;
}

?>

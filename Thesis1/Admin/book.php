<?php
include_once( "connection/connection.php" );
$con = connection();

session_start();


$user = $_SESSION['UserLogin'];
$userID = $_SESSION['UserID'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $famName = $_POST['familyMembersName'];

    global $famName;
}

if ( isset( $_GET['date'] ) ) {
    $date = $_GET['date'];
    global $date;
    
    $stmt = $con->prepare( "SELECT * FROM bookinglog WHERE date =?");
    $stmt->bind_param( 's', $date);
    $bookings = array();
    if ( $stmt->execute() ) {
        $result = $stmt->get_result();
        if ( $result->num_rows>0 ) {
            while( $row = $result->fetch_assoc() ) {
                $bookings[] = $row['timeslot'];
            }

            $stmt->close();
        }
    }
}

if ( isset( $_POST['submit'] ) ) {
    $timeslot = $_POST['timeslot'];
    $optservices = $_POST['serviceOpt'];
    
    $stmt = $con->prepare( "SELECT * FROM bookinglog WHERE date =? AND timeslot = ?");
    $stmt->bind_param( 'ss', $date, $timeslot);

    if ( $stmt->execute() ) {
        $result = $stmt->get_result();
        if ( $result->num_rows>0 ) {
           echo '<script>alert("Already have a reservation")</script>';
           
        }else{
            $stmt = "INSERT INTO `bookinglog`(`userID`, `serviceName`, `date`, `timeslot`,`status`, `FamMemberName`) VALUES ('$userID','$optservices','$date','$timeslot','Pending','$famName')";
            
            $exe = $con -> query( $stmt );
            echo '<script>alert("Sucessfully Reserved")</script>';
            $bookings [] = $timeslot;
        }
    }
   
}

$duration = 30;
$cleanup = 0;
$start = "08:00";
$end = "17:00";
$excludeEnd = "13:00";
$excludeStart = "12:00";

// function timeslots($duration, $cleanup, $start, $end, $excludeStart, $excludeEnd) {
//     $start = new DateTime($start);
//     $end = new DateTime($end);
//     $interval = new DateInterval("PT" . $duration . "M");
//     $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
//     $slot = array();

//     $excludeStartTime = new DateTime($excludeStart);
//     $excludeEndTime = new DateTime($excludeEnd);
//     $now = new DateTime();

//     for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
//         $endPeriod = clone $intStart;
//         $endPeriod->add($interval);

//         // Check if the entire slot is within the excluded range
//         if ($intStart >= $excludeStartTime && $endPeriod <= $excludeEndTime) {
//             continue; // Skip this slot
//         }

//         // Check if the slot partially overlaps with the excluded range
//         if ($intStart < $excludeEndTime && $endPeriod > $excludeStartTime) {
//             continue; // Skip this slot
//         }
        
//         if ($intStart < $now && $endPeriod > $now) {
//             continue; // Skip this slot
//         }


//         if ($endPeriod > $end) {
//             break;
//         }

//         $slot[] = $intStart->format("h:i A") . " - " . $endPeriod->format("h:i A");
//     }

//     return $slot;
// }

function timeslots($duration, $cleanup, $start, $end, $excludeStart, $excludeEnd) {
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slot = array();

    $excludeStartTime = new DateTime($excludeStart);
    $excludeEndTime = new DateTime($excludeEnd);
    $now = new DateTime(); // Get the current time

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);

        // Check if the entire slot is within the excluded range
        if ($intStart >= $excludeStartTime && $endPeriod <= $excludeEndTime) {
            continue; // Skip this slot
        }

        // Check if the slot partially overlaps with the excluded range
        if ($intStart < $excludeEndTime && $endPeriod > $excludeStartTime) {
            continue; // Skip this slot
        }


        if ($endPeriod > $end) {
            break;
        }


        $slot[] = $intStart->format("h:i A") . " - " . $endPeriod->format("h:i A");


    }

    return $slot;
}


?>



<!DOCTYPE html>
<html lang = "en">
<head>
<meta charset = "UTF-8">
<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity = "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin = "anonymous">
<style>
        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .timeslot-container {
            text-align: center;
        }
    </style>
</head>
<body>
<!-- <div class = "container">
<h1 class = "text-center">Book for Date:<?php echo date( 'F d,Y', strtotime( $date ) );
?></h1><hr>
<div class = "row">
<div class = "col-md-6">
<form action = "" method = "post">
<div class = "form-group">
<label for = "">Name</label>
<input type = "text" class = "form-control" name = "name">
</div>
<div class = "form-group">
<label for = "">Email</label>
<input type = "text" class = "form-control" name = "email">
</div>
<button class = "btn btn-primary" type = "submit" name = "submit">Submit</button>
</form>
</div>
</div>
</div> -->

<div class="container container-center">
        <div class="timeslot-container">
            <h1 class="text-center">Book for Date: <?php echo date('m/d/y', strtotime($date)); ?></h1>
            <div class="row">
                <?php
                $timeslots = timeslots($duration, $cleanup, $start, $end,$excludeStart,$excludeEnd);
                foreach ($timeslots as $ts) {
                ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <?php if (in_array($ts, $bookings)) { ?>
                                <button class="btn btn-danger book" disabled><?php echo $ts; ?></button>
                            <?php } else { ?>
                                <button class="btn btn-success book" data-timeslot="<?php echo $ts ?>"><?php echo $ts; ?></button>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div id = "myModal" class = "modal fade" role = "dialog">
    <div class = "modal-dialog">

    <!-- Modal content-->
    <div class = "modal-content">
    <div class = "modal-header">
    <h4 class = "modal-title">Booking</h4>
    <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
    </div>
    <div class = "modal-body">
    <div class = "row">
    <div class = "col-md-12">
    <form action = "" method = "post">
    <div class = "form-group">
    <label for = "">Timeslot</label>
    <input required type = "text" readonly name = "timeslot" id = "timeslot" class = "form-control">
    </div>

    <div class = "form-group">
    <select name="serviceOpt" id="">
                                        <?php
                                            $sqlquery = "SELECT serviceName FROM servicetbl";  
                                            $result = $con->query($sqlquery);
                                            if($result -> num_rows> 0)
                                            {
                                                while($optionData = $result->fetch_assoc())
                                                {
                                                    $option = $optionData['serviceName'];
                                                    

                                        ?>

                                        <option value="<?php echo $option?>"> <?php echo $option?></option>

                                        <<?php
                                            }}
                                        ?>
                                        </select>
    </div>

    <div class = "form-check">
    <input  type = "checkbox" name = "checkbox-fam" id = "checkbox-fam" class="form-check-input">
    <label for = "checkbox-user">Check if Reservation is for Family Members</label>
    </div>

    <div class = "form-group">
    <label for = "">Family Members Name</label>
    <?php
    $readOnlyAttribute = isset($_POST['checkbox-fam']) ? '' : 'readonly';
    ?>
    <input required readonly type = "text"  class = "form-control" name = "familyMembersName">
    </div> 
  

    <div class = "form-group pull-right">
    <button class = "btn btn-primary" type = "submit" name = "submit">Submit</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    <div class = "modal-footer">
    </div>
    </div>

    </div>
    </div>
    <script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity = "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity = "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin = "anonymous"></script>

    <script>
    $( ".book" ).click( function() {
        var timeslot = $( this ).attr( 'data-timeslot' );
        $( "#slot" ).html( timeslot );
        $( "#timeslot" ).val( timeslot );
        $( "#myModal" ).modal( "show" );
    }

    
)
</script>
<script>
    document.getElementById('checkbox-fam').addEventListener('change', function() {
        var inputField = document.getElementsByName('familyMembersName')[0];
        inputField.readOnly = !this.checked;
    });
</script>
</body>
</html>
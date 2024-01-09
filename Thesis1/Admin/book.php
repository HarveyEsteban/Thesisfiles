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

if ( isset($_GET['date']) && isset($_GET['service']) ) {
    $date = $_GET['date'];
    $selectedService = $_GET['service'];
    global $selectedService;
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
    $stmt = $con->prepare( "SELECT * FROM bookinglog WHERE date =? AND timeslot = ? AND status = 'Pending'");
    $stmt->bind_param( 'ss', $date, $timeslot);

    if ( $stmt->execute() ) {
        $result = $stmt->get_result();
        if ( $result->num_rows > 0 ) {

            echo '<div class="alert alert-danger" role="alert">
                  Cannot be reserve slot is already taken!
                </div>';

        }else{

            $famName = empty($famName) ? 'None' : $famName;
            $stmt = "INSERT INTO `bookinglog`(`userID`, `serviceName`, `date`, `timeslot`,`status`, `FamMemberName`) VALUES ('$userID','$selectedService','$date','$timeslot','Pending','$famName')";
            
            $exe = $con -> query( $stmt );
                        echo '<div class="alert alert-success" role="alert">
                  Successfuly Reserve the slot!
                </div>';
            $bookings [] = $timeslot;
        }
    }
   
}

$duration = 30;
$cleanup = 0;
$start = "09:00";
$end = "17:00";
$excludeEnd = "13:00";
$excludeStart = "12:00";


function isPastTimeslot($timeslot) {
    global $date;

    $currentDateTime = new DateTime();
    $timeslotDateTime = DateTime::createFromFormat('h:i A', explode(' - ', $timeslot)[0]);

    return $timeslotDateTime < $currentDateTime;
}


function isCancelled($timeslot)
{
    global $con;
    global $date;

    $checkisCancel = "SELECT * FROM `bookinglog` WHERE timeslot = '$timeslot' AND status = 'Cancel' AND date = '$date'";
    $exe = $con->query($checkisCancel);
    $total = $exe->num_rows;

    return ($total > 0);
}

function isPending($timeslot){
    global $con;
    global $date;

    $checkifPending = "SELECT * FROM `bookinglog` WHERE timeslot = '$timeslot' AND status = 'Pending' AND date = '$date'";
    $exe = $con->query($checkifPending);
    $total = $exe->num_rows;

    return ($total > 0);
}

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
    .modal-footer {
        text-align: center;
    }
</style>


<style>

    


    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column; /* Set the main axis to be vertical */
        justify-content: center;
        align-items: center;
        background-color: #f8f0d2;
    }

    .container-center {
        background-color: #e9e4d0;
        padding: 20px; /* Adjust the padding as needed */
        border-radius: 10px; /* Optional: Add border-radius for rounded corners */
        background-image: url(assets/img/cover.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center; /* Center the background image both horizontally and vertically */
    }  
    .space-below {

        padding: 20px;
        height: 20px; /* Adjust the height of the space below as needed */
    }
</style>
</head>
<body>

<div class="container container-center">
    <div class="timeslot-container">
        <h1 class="text-center"><?php echo date('m/d/y', strtotime($date)); ?></h1>
        <div class="row">
            <?php
            $timeslots = timeslots($duration, $cleanup, $start, $end, $excludeStart, $excludeEnd);
            // echo "Timeslot: $ts | isCancelled: " . (isCancelled($ts) ? 'true' : 'false') . " | isPending: " . (isPending($ts) ? 'true' : 'false') . " | Booked: " . (in_array($ts, $bookings) ? 'true' : 'false') . "<br>";

foreach ($timeslots as $ts) {
    ?>
    <div class="col-md-2">
        <div class="form-group">
            <?php
            if (in_array($ts, $bookings)) {
                ?>
                <?php if (isCancelled($ts) && isPending($ts)) { ?>
                    <button class="btn btn-danger book" disabled><?php echo $ts; ?></button>
                <?php } else if(isPending($ts)) { ?>
                    <button class="btn btn-danger book" disabled><?php echo $ts; ?></button>
                <?php } else { ?>
                    <button class="btn btn-success book" data-timeslot="<?php echo $ts ?>"><?php echo $ts; ?></button>
                <?php } ?>
            <?php } else { ?>
                <button class="btn btn-success book" data-timeslot="<?php echo $ts ?>"><?php echo $ts; ?></button>
            <?php } ?>
        </div>
    </div>
<?php } ?>
        </div>
    </div>
</div>


<div class="space-below">
    <a href="patientServices.php" class="btn btn-lg" style="background-color: #bab395;">Go Back</a>
</div>

    <div id="user_model_details"></div>


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
            <label for = "">Service</label>
            <input required type = "text" readonly name = "serviceopt" id="sericeopt" value="<?php echo $selectedService;?>"  class = "form-control">
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

    </div>

    </div>
    </div>
    <script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity = "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity = "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin = "anonymous">
    </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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
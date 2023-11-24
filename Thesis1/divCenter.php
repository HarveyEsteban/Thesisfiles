<?php
include_once( "connection/connection.php" );
$con = connection();
if ( isset( $_GET['date'] ) ) {
    $date = $_GET['date'];
    global $date;
    
    $stmt = $con->prepare( "SELECT * FROM bookrecords WHERE date =?");
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $timeslot = $_POST['timeslot'];
    $stmt = $con->prepare( "SELECT * FROM bookrecords WHERE date =? AND timeslot = ?");
    $stmt->bind_param( 'ss', $date, $timeslot);

    if ( $stmt->execute() ) {
        $result = $stmt->get_result();
        if ( $result->num_rows>0 ) {
           echo '<script>alert("Already have a reservation")</script>';
           
        }else{
            $stmt = "INSERT INTO `bookrecords`(`name`, `email`, `date`, `timeslot`) VALUES ('$name','$email','$date','$timeslot')";
            $exe = $con -> query( $stmt );
            $bookings [] = $timeslot;
        }
    }
   
}

$duration = 30;
$cleanup = 0;
$start = "09:00";
$end = "15:00";

function timeslots( $duration, $cleanup, $start, $end ) {
    $start = new DateTime( $start );
    $end = new DateTime( $end );
    $interval = new DateInterval( "PT".$duration."M" );
    $cleanupInterval = new DateInterval( "PT".$cleanup."M" );
    $slot = array();

    for ( $intStart = $start; $intStart<$end; $intStart->add( $interval )->add( $cleanupInterval ) ) {
        $endPeriod = clone $intStart;
        $endPeriod->add( $interval );
        if ( $endPeriod>$end ) {
            break;
        }
        $slot[] = $intStart-> format( "H:iA" )."-".$endPeriod->format( "H:iA" );
    }

    return $slot;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
                body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .centered-div {
            width: 300px; /* Set the width as per your design */
            padding: 20px;
            border: 1px solid #ccc;
            text-align: center;
        }

    </style>
</head>
<body>
<div class="centered-div">
<div class = "container">
<h1 class = "text-center">Book for Date: <?php echo date( 'm/d/y', strtotime( $date ) );
?></h1>
<div class = "row">
<?php
$timeslots = timeslots( $duration, $cleanup, $start, $end );
foreach ( $timeslots as $ts ) {
    ?>
    <div class = "col-md-2">
    <div class = "form-group">
        <?php if(in_array($ts, $bookings)){?>
    <button class = "btn btn-danger book"> <?php echo $ts;
    ?></button>
        <?php }else{?>
    <button class = "btn btn-success book" data-timeslot = "<?php echo $ts ?>"> <?php echo $ts;
    ?></button>
    <?php }?>
    </div>
    </div>
    <?php }?>
    </div>
    </div>

    <div id = "myModal" class = "modal fade" role = "dialog">
    <div class = "modal-dialog">

    <!-- Modal content-->
    <div class = "modal-content">
    <div class = "modal-header">
    <button type = "button" class = "close" data-dismiss = "modal">&times;
    </button>
    <h4 class = "modal-title">Booking <span id = "slot"></span></h4>
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
    <label for = "">Name</label>
    <input required type = "text" class = "form-control" name = "name">
    </div>
    <div class = "form-group">
    <label for = "">Email</label>
    <input required type = "email" class = "form-control" name = "email">
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
</body>
</html>
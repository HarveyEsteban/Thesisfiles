<?php
    include_once("connection/connection.php");
    $con = connection();

    $userID = 1;

    function createTimeslot($start_time, $end_time, $date)
    {
    global $con;
    $sql = "INSERT INTO timeslot (start_time, end_time, date) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $start_time, $end_time, $date);
    return $stmt->execute();
    }

    //timeslot example
    //Try using the time of the current day (realtime) for the date
    // createTimeslot('09:00:00', '10:00:00', '2023-09-28');
    // createTimeslot('10:00:00', '11:00:00', '2023-09-28');


        if(isset($_POST['Reserve']))
        {
            $service = $_POST['serviceOpt'] ;


           echo $service;
        }

    if(isset($_POST['TimeSlot']))
    {
        $getfirstdate = $_POST['TimeSlot'];
        $getarrDate = explode(",", $getfirstdate);

         $datepick = $_POST['datepicker'];
         $startDate = $getarrDate[0]; 
         $endDate = $getarrDate[1];

         


        $is_avail = checkslot($startDate,$endDate,$datepick);

         if($is_avail == true)
         {
            echo '<script>alert("Dup")</script>'; //if dup select another timeslot and disable button
         }
         else
         {
            echo $service;
         }




        // createTimeslot($startDate,$endDate,$todaysDate);
        // echo '<script>alert("Success")</script>';
    }

    function checkslot($cstart_time, $cend_time, $cdate)
    {
        global $con;

        $sql = "SELECT * FROM `timeslot` WHERE start_time = '$cstart_time' AND end_time = '$cend_time' AND date = '$cdate'";
        $exeSQL = $con->query($sql);
        $total = $exeSQL->num_rows;
        
      
        if($total > 0)
        { //meaning there's is a existing reservation slots
            return true;
        }
        else
        {//there are no existing reservation slots
            return false;
        }


        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testing</title>
</head>
<body>
    
    <form action="" method="post">
     
    
    <select name="serviceOpt" id="">
    <?php
         $sqlquery = "SELECT serviceID, serviceName FROM services";  
        $result = $con->query($sqlquery);
        if($result -> num_rows> 0)
        {
            while($optionData = $result->fetch_assoc())
            {
                $option = $optionData['serviceName'];
                $id = $optionData['serviceID'];

    ?>

    <option value="<?php echo $id?>"> <?php echo $option?></option>

    <<?php
        }}
    ?>
    </select>
                                
    <label for="datepicker">Please Select a date and a time slot available</label>
    <input type="date" id="datepicker" name="datepicker"> <br>


    <button name="Reserve" type="submit">Reserve</button>

    <br>
    <button name="TimeSlot" type="submit" value="08:00:00,08:30:00">08:00:00,08:30:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="08:30:00,09:00:00">08:30:00,09:00:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="09:00:00,09:30:00">09:00:00,09:30:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="09:30:00,10:00:00">09:30:00,10:00:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="10:00:00,10:30:00">10:00:00,10:30:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="10:30:00,11:00:00">10:30:00,11:00:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="11:00:00,11:30:00">11:00:00,11:30:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="11:30:00,12:00:00">11:30:00,12:00:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="01:00:00,01:30:00">01:00:00,01:30:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="01:30:00,02:00:00">01:30:00,02:00:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="02:00:00,02:30:00">02:00:00,02:30:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="02:30:00,03:00:00">02:30:00,03:00:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="03:00:00,03:30:00">03:00:00,03:30:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="03:30:00,04:00:00">03:30:00,04:00:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="04:00:00,04:30:00">04:00:00,04:30:00</button>
    <br>
    <button name="TimeSlot" type="submit" value="04:30:00,05:00:00">04:30:00,05:00:00</button>
    <br>
    </form>


</body>
</html>
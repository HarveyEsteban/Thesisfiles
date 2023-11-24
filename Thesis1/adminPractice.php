<?php
        include_once("connection/connection.php");
        $con = connection();

   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample admin interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body style="margin: 50px">

<h1> Sample Admin Layout for reservation</h1>


<table class="table">

<thead>


<tr>

<th>User ID</th>
<th>Service</th>
<th>Start_Date</th>
<th>End_Date</th>
<th>Actions</th>

</tr>

</thead>

<tbody>



<?php
    $retrieveQuery = "SELECT * FROM `reservation` WHERE STATUS = 'Pending'";
    $result =  $con -> query($retrieveQuery);

    if(isset($_GET['delID'])){
        $usID = $_GET['delID'];

        $changeStatus = "UPDATE `reservation` SET `status`='Done' WHERE userID = '$usID'";
        $exeQuery = mysqli_query($con,$changeStatus);

    }

    while($row = mysqli_fetch_assoc($result)){

        $id = $row['userID'];
        $service = $row['service'];
        $start = $row['start_date'];
        $endDate = $row['end_date'];
    echo '<tr>
        
    <td>'.$id.'</td>
    <td>'.$service.'</td>
    <td>'.$start.'</td>
    <td>'.$endDate.'</td>
    <td>
        <button class = "btn btn-primary"><a href = "adminPractice.php?delID='.$id.'" class ="btn btn-danger">Done</a></button>
    </td>
      </tr>';


    }
?>
</tbody>

</table>
    
</body>
</html>
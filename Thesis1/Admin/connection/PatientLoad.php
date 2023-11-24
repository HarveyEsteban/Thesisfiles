<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=patientsdb', 'root', 'Thesis1');

$data = array();

// $query = "SELECT * FROM reservation ORDER BY 	reservationID";

// $query = "SELECT * FROM reservation WHERE status = 'Pending' ORDER BY reservationID";

$query = "SELECT reservation.reservationID, patients_user.Name, reservation.start_date, reservation.end_date
FROM reservation
INNER JOIN patients_user ON reservation.userID=patients_user.userID WHERE status = 'Pending' ORDER BY reservationID";

// use Where to filter the reservation Sample SELECT * FROM reservation ORDER BY reservationID WHERE status = 'Pending' - try to check if this code will work

// use Where to filter select and filter list of patients who cancel sample query SELECT * FROM reservationID WHERE status = 'Canceled' this will get the list of reservation who canceled

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{

 $data[] = array(
//   'id'      => $row["id"],
  'title'   => $row["reservationID"],
  'start'   => $row["start_date"],
  'end'     => $row["end_date"]
 ); 
 
}

echo json_encode($data);

?>
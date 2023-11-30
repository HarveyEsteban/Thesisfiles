<?php

//update_last_activity.php

include('connection/connection.php');

session_start();

$query = "
UPDATE patients_user 
SET last_activity = now() 
WHERE userID = '".$_SESSION["userID"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>
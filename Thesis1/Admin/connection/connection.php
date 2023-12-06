<?php

$connect = new PDO("mysql:host=localhost;dbname=patientsdb", "root", "Thesis1");

    
    function connection(){

        $host = "localhost";
        $username = "root";
        $password = "Thesis1";
        $database = "patientsdb";
        
         $con = new mysqli($host, $username, $password, $database);

         if ($con->connect_error) {
            echo $con->connect_error;
         }
         else{
            return $con;
         }
    }

    function cancelUser($resID, $connect){

            $sqlCheck = "SELECT * FROM `confirmation_data` WHERE confirmed = '0'";
            $stmt = $connect->prepare($sqlCheck);
            $stmt ->execute();
            $result = $stmt -> rowCount();



            if($result > 0){
               $CheckifConfirm = "UPDATE `bookinglog` SET `status`='Cancel' WHERE resID = '$resID'";
               $stmt = $connect->prepare($CheckifConfirm);
               $stmt -> execute();

            }

            





    }


    function fetch_user_last_activity($user_id, $connect)
   {
      $query = "
      SELECT * FROM patients_user 
      WHERE userID = '$user_id' 
      ORDER BY last_activity DESC 
      LIMIT 1
      ";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();

      foreach($result as $row)
      {
       return $row['last_activity'];
      }
   }

   function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') 
 OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') 
 ORDER BY timestamp 
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["chat_message"].'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 $query = "
 UPDATE chat_message 
 SET status = '0' 
 WHERE from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."' 
 AND status = '1'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $output;
 return $output;
}

function get_user_name($user_id, $connect)
{
 $query = "SELECT Name FROM patients_user WHERE userID = '$user_id'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['Name'];
 }
}


function count_unseen_message($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}

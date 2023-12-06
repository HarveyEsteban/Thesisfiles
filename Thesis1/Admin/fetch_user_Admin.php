<?php
    include_once("connection/connection.php");
    $con = connection();
    session_start();

    $userID = $_SESSION['UserID'];

    // $stmt = "SELECT * FROM `patients_user` WHERE userID != $userID";
    $stmt = "SELECT * FROM `patients_user` WHERE userID != '$userID'";
    $statement = $connect->prepare($stmt);

    $statement->execute();
    
    $result = $statement->fetchAll();



    $output = '
        <table class="table table-bordered table-striped">
        <tr>
        <td>Username</td>
        <td>Unseen Message</td>
        <td>Action</td>
        </tr>
        ';



    foreach($result as $row) {

        $status = '';
        $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
        $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
        $user_last_activity = fetch_user_last_activity($row['userID'], $connect);
        
        if($user_last_activity > $current_timestamp){
            $status = '<span class="label label-success">Online</span>';

         }else{
            $status = '<span class="label label-danger">Offline</span>';
         }
        $output .= '
            <tr>
            <td class="table-warning">'.$row['Name'].'</td>
            <td class="table-warning">'.count_unseen_message($row['userID'], $_SESSION['UserID'], $connect).'</td>
            <td class="table-warning"><button type="button" class="btn btn btn-xs start_chat" data-touserid="'.$row['userID'].'" data-tousername="'.$row['Name'].'">Start Chat</button></td>
            </tr>
        ';
    }

    $output .= '</table>';

    echo $output;
?>

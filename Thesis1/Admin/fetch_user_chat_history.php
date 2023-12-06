
<?php

//fetch_user_chat_history.php

include('connection/connection.php');

session_start();

echo fetch_user_chat_history($_SESSION['UserID'], $_POST['to_user_id'], $connect);

?>
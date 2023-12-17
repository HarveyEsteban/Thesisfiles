<?php
include_once("connection/connection.php");
$con = connection();
session_start();

if(isset($_GET['AuthEmail']))
{
	$email = $_GET['AuthEmail'];

	echo $email."<br>";

	$verify = "SELECT * FROM patients_user WHERE Email = '$email'";
	$exe = $con->query($verify);
	$row = $exe -> fetch_assoc();
	$total = $exe->num_rows;

	if($total > 0)
	{
		$_SESSION['UserID'] = $row['userID']; 
        $_SESSION['UserLogin'] = $row['Name'];
        header('Location: patientInterface.php');
        exit();
	}
}


?>
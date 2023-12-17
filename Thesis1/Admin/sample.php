<?php
include_once("connection/connection.php");
$con = connection();

session_start();

if(!isset($_SESSION['access_token'])){
	header("Location: login.php");
	exit();
}

if(isset($_POST['btn_submit']))
{
	$name = $_SESSION['userData']['name'];
	$email = $_SESSION['userData']['email'];



	$sql = "INSERT INTO `patients_user`(`Email`, `Name`,`Access`) VALUES ('$email','$name','User')";
	$exe = $con -> query($sql);

	header("Location: VerifyFB.php?AuthEmail=".urlencode($email));
	exit();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<title>My profile</title>
</head>
<body>
	
<div class="container" style="margin-top: 100px">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<table class="table table-hover table-bordered">
				<h2>Welcome</h2>
				<tbody>
					<tr>
						<td>Name</td>
						<td><?php echo $_SESSION['userData']['name'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $_SESSION['userData']['email'] ?></td>
					</tr>


				</tbody>
			</table>
			<form action="" method="post">
				<button type="submit" class="btn btn-primary btn-lg btn-block" name="btn_submit">Click here to continue</button>
			</form>
		</div>
	</div>
</div>


</body>
</html>
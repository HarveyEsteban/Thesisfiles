<?php

if(!isset($_SESSION)){
    session_start();
}

    include_once("connection/connection.php");

    $con = connection();

if(isset($_POST['login-button'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    
    $sql = "SELECT * FROM patient_users WHERE username = '$username' AND password = '$password' AND active = '1'";
    $patient = $con->query($sql) or die($con->error);
    $row = $patient->fetch_assoc();
    
    $total = $patient->num_rows;
    
    
    // check if the fields are not empty
    if(empty($username) || empty($password) )
{
    echo '<script>alert("Please fill out the form")</script>';

}else {

    //check if the user is login
    if ($total > 0) {
    
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];

        

        if (isset($_SESSION['Access']) && $_SESSION['Access'] == "Administrator") {
            echo header("Location: admin.php");
        }

       else if(isset($_SESSION['Access']) && $_SESSION['Access'] =="User" ){

            echo header("Location: interface.php");
        }
    
    }else {
        echo '<script>alert("Incorrect Username or password")</script>';
    }
}

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Log in Page</title>
</head>
<body>
    <div clas="Topbar-Menu">
    <a href="landingpage.php" ><img  id="Logo" style="float: left;" src="img/The_dental_pod-removebg-preview.png" alt="logo"></a>        
    <div id="DentalPod" style="float: left;">
            <h2 id="name">
                The Dental Pod
            </h2>

            <h3 id="tagline">
                Serving you with a better smile
            </h3>
        </div>

        <div style="float: right; "class="selection">
          <a href="" style="display: inline;">About Us</a>
          <a href="" style="display: inline;" >Services</a>
        </div>
    </div>

    <div class="content">
        <div class="container-login">
            <form action="" method = "post">
                <label class="label" for="userName">Username</label>
                <br>
                <input class="input" type="text" name="username" id="username"><br>
                <br>
                <label class="label" for="password">Password</label><br>
                <input class="input" type="password" name="password" id="password"><br><br>
                <input id="login-btn" type="submit" name="login-button" value="Login">
                <br>
                <a href="signup.php">Sign Up</a>
            </form>
        </div>
    </div>
        

</body>
</html>
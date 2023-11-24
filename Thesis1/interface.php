<?php

include_once("connection/connection.php");
$con = connection();

//logout button for user
    session_start();

    $user = $_SESSION['UserLogin'];

    if(isset($_POST['Logout'])){
            unset($_SESSION['UserLogin']);
            unset($_SESSION['Access']);

            echo header("Location: landingpage.php");
    }
    //end of logout button

    //Change Password
    // $oldpass = $_POST['oldpassword'];
    // $newpass = $_POST['newpassword'];
    // $reenterpass = $_POST['reenterpassword'];

    // $sqlselect = "SELECT `password` FROM `patient_users` WHERE username ='$user' "; //select password by comparing user in session and username in db
    // $user = $con->query($sqlselect) or die($con->error);
    // $row = $user->fetch_assoc();
    
    // if ($reenterpass($oldpass,$row['password'])) {
    //     if($reenterpass = ''){
    //         echo '<script>alert("Please confirm password")</script>';

    //     }
    //     if($newpasspass){

    //     }
    // }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/interface.css">
        <title>Admin Page</title>
    </head>
    <body>
    <div clas="Topbar-Menu">
        <img id="Logo" style="float: left;" src="img/The_dental_pod-removebg-preview.png" alt="logo">
        <div id="DentalPod" style="float: left;">
            <h2 id="name">
                The Dental Pod
            </h2>
            <h3 id="tagline">
                Serving you with a better smile
            </h3>
        </div>

        <div style="float: right; "class="selection">
          <a href="#container-aboutus" style="display: inline;">About Us</a>
          <a href="" style="display: inline;" >Services</a>
        </div>
    </div>
    
        <h2>Welcome</h2>
        <form action="" method="post">

        <button type = "submit" name = "Logout">Logout</button>
        </form>
       
        <div class = "containerCpass">
        <div class = "changePassword">
            <form action="post">
            
            <label>Enter Password</label>
            <br>
            <input class = "input" type="password" name ="oldpassword" id="password">
            <br>
            <label>Enter New Password</label>
            <br>
            <input class = "input" type="password" name ="newpassword" id="password">
            <br>
            <label> Re Enter New Password</label>
            <br>
            <input  class = "input" type="password" name ="reenterpassword" id="password">
            <br>
            <button class="changepassbtn" type ="submit" name ="changepass">Change Password</button>
            <br>
            </form>
           
        </div>
        </div>
        
    </body>
    </html>
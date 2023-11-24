<?php
    include_once("connection/connection.php");
    $con = connection();

if(isset($_GET['updateID']))
$id = $_GET['updateID'];

    if(isset($_POST['submit-btn']))
    {
        $getselected = $_POST['serviceOpt'];

        $updateServicestmt = "UPDATE `reservation` SET `serviceName`='$getselected'WHERE reservationID = $id";
        $run = $con -> query($updateServicestmt);
        echo "<script>alert('Sucessfully Updated')</script>";
        header("Location: PatientsOwnReservation.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Centered Form</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    form {
      width: 300px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <form method="POST">
        <select name="serviceOpt" id="">
        <?php
            $sqlquery = "SELECT serviceName FROM servicetbl";  
            $result = $con->query($sqlquery);
            if($result -> num_rows> 0)
            {
                while($optionData = $result->fetch_assoc())
                {
                    $option = $optionData['serviceName'];
                    

        ?>

        <option value="<?php echo $option?>"> <?php echo $option?></option>

        <<?php
            }}
        ?>
        </select>
        <br>
        <br>
    <button type="submit" name="submit-btn" id="submit-btn">Submit</button>
  </form>

</body>
</html>

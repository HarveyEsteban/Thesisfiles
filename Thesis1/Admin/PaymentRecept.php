<?php
    
    include_once("connection/connection.php");
    $con = connection();


    if(isset($_GET['doneID']))
    {
        $paymentID = $_GET['doneID'];
        global $paymentID;
    }


    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        form {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        input, button {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>PAYMENT</h2>
    <form class="mt-3" method="POST">
    <?php
            $getReservation = "SELECT * FROM `bookinglog` WHERE resID = '$paymentID'";
            $exe = $con -> query($getReservation);
            $total  = $exe -> num_rows;


            if($total > 0)
            {
                $stmt = "SELECT bookinglog.serviceName, servicetbl.price,patients_user.Name
                FROM bookinglog
                JOIN patients_user ON bookinglog.userID = patients_user.userID
                JOIN servicetbl ON bookinglog.serviceName = servicetbl.serviceName
                WHERE resID = '$paymentID'";

                $exestmt = $con->query($stmt);
                $row = $exestmt->fetch_assoc();
                
                $SName = $row['serviceName'];
                $Sprice = $row['price'];
                $Pname = $row['Name'];

                    
            ?>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" readonly class="form-control" id="Service" name="Service" value="<?php echo $Pname; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" readonly class="form-control" id="Service" name="Service" value="<?php echo $SName; ?>" required>
        </div>

        <div class="form-group">
            <label for="ammount">Ammount</label>
            <input readonly type="text" class="form-control" id="ammount" value="<?php echo $Sprice; ?>" name="ammount" required>
        </div>

        <div class="form-group">
            <label for="ammount">Additional Charges</label>
            <input  type="text" class="form-control" id="charges" name="charges" required placeholder="Please Enter the amount of additional charges if there is any...">
        </div>

        <button type="submit" name="btn-Payment" class="btn btn-success">Done</button>


        <?php
                        
            }else{
                echo "<scrip>alert('Error...')</script>";
            }
        ?>
    </form>
</div>

<!-- Bootstrap JS and Popper.js CDN -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>

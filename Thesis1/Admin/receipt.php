<?php
include_once("connection/connection.php");
$con = connection();

if (isset($_GET['paymentID'])) {
    $paymentID = $_GET['paymentID'];

    $getReservation = "SELECT * FROM `bookinglog` WHERE resID = '$paymentID'";
    $exe = $con->query($getReservation);
    $total = $exe->num_rows;

    if ($total > 0) {
        $stmt = "SELECT bookinglog.serviceName, servicetbl.price, patients_user.Name
                FROM bookinglog
                JOIN patients_user ON bookinglog.userID = patients_user.userID
                JOIN servicetbl ON bookinglog.serviceName = servicetbl.serviceName
                WHERE resID = '$paymentID'";

        $exestmt = $con->query($stmt);
        $row = $exestmt->fetch_assoc();

        $Pname = $row['Name'];
        $SName = $row['serviceName'];
        $Sprice = $row['price'];
        $additionalCharge = isset($_POST['charges']) ? $_POST['charges'] : 0;

        // Calculate total amount
        $totalAmount = $Sprice + $additionalCharge;

        // Fetch reservation details for display
        $reservationDetailsStmt = "SELECT * FROM `bookinglog` WHERE resID = '$paymentID'";
        $reservationDetailsResult = $con->query($reservationDetailsStmt);
        $reservationDetails = $reservationDetailsResult->fetch_assoc();
    } else {
        echo "<script>alert('Error...')</script>";
    }
} else {
    header("Location: receptionistUI.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>

    <!-- Bootstrap CSS CDN -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .container {
            text-align: left;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Adjust the maximum width as needed */
            width: 100%;
        }

        h2 {
            color: #007bff;
            text-align: center;
        }

        h4 {
            color: #495057;
        }

        p {
            color: #6c757d;
        }
        input{
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        .form-control[readonly] {
            border: none;
            background-color: transparent;
        }



        .btn-print:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>RECEIPT</h2>
    <div class="mt-3">
        <div class="form-group">
            <label for="reservationID">Reservation ID</label>
            <input type="text" class="form-control" id="reservationID" readonly value="<?php echo $paymentID; ?>">
        </div>
        <div class="form-group">
            <label for="serviceName">Service Name</label>
            <input type="text" class="form-control" id="serviceName" readonly value="<?php echo $SName; ?>">
        </div>
        <div class="form-group">
            <label for="customerName">Customer Name</label>
            <input type="text" class="form-control" id="customerName" readonly value="<?php echo $Pname; ?>">
        </div>
        <div class="form-group">
            <label for="totalAmount">Total Amount</label>
            <input type="text" class="form-control" id="totalAmount" readonly value="<?php echo "₱" . $totalAmount; ?>">
        </div>

        <div class="form-group">
            <label for="additionalCharges">Charges</label>
            <input type="text" class="form-control" id="additionalCharges" readonly value="<?php echo "₱" . $additionalCharge; ?>">
        </div>

        <form method="post">
            <div class="form-group">
                <label for="paymentMethod">Payment Method</label>
                <input type="text" class="form-control" id="paymentMethod" name="paymentMethod" placeholder="Enter payment method">
            </div>
            <button type="button" onclick="printReceipt()" class="btn btn-print btn-lg btn-block btn-success">Print Receipt</button>
            <a href="receptionistUI.php" class="btn btn-lg btn-block btn-info">Go Back</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS and Popper.js CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    function printReceipt() {
        // Disable the print button to prevent multiple clicks
        document.querySelector('.btn-print').disabled = true;

        // Trigger the print dialog
        window.print();

        // Enable the print button after the print dialog is closed
        setTimeout(function() {
            document.querySelector('.btn-print').disabled = false;
        }, 500);
    }
</script>
</body>
</html>

<?php
include_once("connection/connection.php");
$con = connection();
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Centered Bootstrap Form</title>
    <style>
        .card {
            max-width: 500px; /* Set the maximum width of the card */
            width: 100%;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="card p-4">
    <h3 class="text-center mb-4">Edit Service</h3>
    
    <form method="post" enctype="multipart/form-data">
    <?php 


    	if(isset($_POST['btn-update']))
    	{

    		$updatename = $_POST['service-name'];
    		$updateprice = $_POST['service-price'];
    		$updatedesc = $_POST['service-description'];
    		$service = $_SESSION['SERVICENAME'];

	    	$file = $_FILES['image'];

	        $fileName = $_FILES['image']['name'];
	        $fileTmpName = $_FILES['image']['tmp_name'];
	        $fileSize = $_FILES['image']['size'];
	        $fileError = $_FILES['image']['error'];
	        $fileType = $_FILES['image']['type'];

	        $fileExt = explode('.', $fileName);
	        $fileActualExt = strtolower(end($fileExt));

	        $allowed = array('jpg', 'jpeg','png');
	    

	        if ($fileName == null) {
            echo '<script>alert("Please Upload a picture for the Service")</script>'; 
        }        else{
            

            if(in_array($fileActualExt, $allowed))
            {
                if($fileError === 0)
                {
                    if($fileSize < 500000)
                    {
                        $fileNameNew = uniqid('', true). "." . $fileActualExt;
                        $fileDestination = 'upload/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
    
                        $sqlStmtImg = "UPDATE `servicetbl` SET `serviceName`='$updatename',`price`='$updateprice',`filename`='$fileDestination',`description`='$updatedesc' WHERE serviceName = '$service'";
                        $exeStmt = $con -> query($sqlStmtImg);
                        echo '<script>alert("Service Succesfully Uploaded")</script>'; 
                    }
                    else{
                        echo "Your file is too big!" ;
                    }
                }
                else
                {
                    echo "There was an error uploading the file";
                }
            }
            else{
                echo "You cannot upload files of this type";
            }

        }


    	}



		if(isset($_GET['serviceName']))
		{
			$serviceName = $_GET['serviceName'];

			$sqlget= "SELECT * from servicetbl WHERE serviceName = '$serviceName'";
			$exe = $con -> query($sqlget);
			$row = $exe -> fetch_assoc();
			$total = $exe -> num_rows;

			if($total > 0)
			{

				if($row)
				{
				$_SESSION['SERVICENAME'] = $row['serviceName'];
				$service = $_SESSION['SERVICENAME'];
				$price = $row['price'];
				$desc = $row['description'];
				$img = $row['filename'];


			?>


        <div class="form-group">
            <label for="field1">Service Name:</label>
            <input type="text" class="form-control" id="service-name" name="service-name" value="<?php echo $service?>" required>
        </div>

        <div class="form-group">
            <label for="field2">Price</label>
            <input type="text" class="form-control" id="service-price" name="service-price" value="<?php echo $price; ?>" required>
        </div>

        <div class="form-group">
            <label for="field3">Description</label>
            <input type="text" class="form-control" id="service-description" name="service-description"  value="<?php echo $desc; ?>" required>
        </div>

           <div class="form-group">
            <label for="field3" >Image</label><br>

            <?php
            	echo " <img src=".$img." style='max-width: 800px; max-height: 340px;''>"
            ?>
        </div>

		 <div class="form-group mb-3">
		    <input required type="file" name="image" id="image">
		</div>

<button type="submit" name="btn-update" class="btn btn-primary btn-lg d-block mx-auto">Update</button>
<br>
    </form>
    <button class="btn btn-primary btn-lg  mx-auto" ><a href="Servicemaintenance.php" class="btn btn-primary btn-lg  mx-auto" >Go Back</a></button>

    				<?php } ?>
    			<?php } ?>
    	<?php } ?>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
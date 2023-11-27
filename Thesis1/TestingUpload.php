<?php

include_once("connection/connection.php");
$con = connection();

    if(isset($_POST['submit']))
    {
        $file = $_FILES['image'];

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg','png');


        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if($fileSize < 500000)
                {
                    $fileNameNew = uniqid('', true). "." . $fileActualExt;
                    $fileDestination = 'upload/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo "Sucess";

                    $sqlStmtImg = "INSERT INTO `servicetbl`(`serviceName`, `price`, `filename`, `description`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')";
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

    if(isset($_POST['view-image']))
    {
        $getImagestmt = "SELECT * FROM `servicetbl`";
        $exegetstmt = $con -> query($getImagestmt);

        if($exegetstmt->num_rows > 0){
            while($row = $exegetstmt->fetch_assoc()){

                echo "<div>";
                echo "<img src='".$row['filename']."'>";
                echo "</div>";
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="image">Choose Image:</label>

    <input type="file" name="image" id="image">
    <input type="submit" value="Upload Image" name="submit">
    <input type="submit" value="View Image"  name="view-image">
</form>

</body>
</html> 
<?php
    if(isset($_POST['img_submit'])){
        $img_name = $_FILES['img_upload'] ['name'];
        $tmp_img_name = $_FILES['img_upload'] ['tmp_name'];

        move_uploaded_file($tmp_img_name,$img_name);
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
    
<form action="" method='POST' enctype ='multipart/form-data'>
<input type="file" name='img_upload'>
<input type="submit" name='img_submit'>

</form>

</body>
</html>
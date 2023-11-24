<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>
    <input type="text" class="inputField" id="inputField">


    <div id="result"></div>
</body>
<script>
        $(document).ready(function(){
            $('#inputField').on('input', function(){

                var inputValue = $(this).val();

$.ajax({
    url: 'showhistory.php',
    type: 'POST',
    data:{inputValue: inputValue},
    success: function(response){
        $('#result').html(response);
    }
})
            })

        })
</script>
</html>
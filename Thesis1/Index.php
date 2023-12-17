
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body data-rsssl=1>
<script src="html5-qrcode.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
main {
display: flex;
justify-content: center;
align-items: center;
}
#reader {
width: 600px;
}
#result {
text-align: center;
font-size: 1.5rem;
}
</style>

<main>
<div id="reader"></div>
<input type="text" name="text" id="text" placeholder="sss" readonly>
</main>

<script>
const scanner = new Html5QrcodeScanner('reader', {
fps: 20,
});
scanner.render(success, error);
function success(result) {
document.getElementById('text').value=(result);
scanner.clear();
document.getElementById('reader').remove();
}
function error(err) {
console.error(err);
}
</script>
  
</body>
</html>


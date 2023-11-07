<?php
if($_SERVER['REQUEST_METHOD']== 'POST'){
    print_r($_FILES);
    $numElementos = count($_FILES['foto']['name']);

    for($i=0;$i<$numElementos; $i++){
        move_uploaded_file($_FILES)
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
<form action="11_subirArchivos.php" method="post" enctype="multipart/form-data">
        <input type="file" name="foto[]" multiple></br>
        <input type="submit" value="login">

        <a href="index.php">Volver</a>

    </form>
</body>
</html>
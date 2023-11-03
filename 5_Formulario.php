<?php
//method= "get"  Se envía por la barra de direcciones y es visible. Tiene un límite de 2000 caracteres y no permite envío de archivos
//method="post"  No es visible en la barra de direcciones. No tiene límite de caracteres y permite el envío de archivos
echo "la peticion de esta pagina se ha hecho por " . $_SERVER['REQUEST_METHOD'] . "<br>";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if($_POST['email']== 'correo@correo' && $_POST['password']== '123'){
        echo "Usuario correcto" . "<br>";
    }else{
        echo"Usuario incorrecto" . "<br>";
    }
    
    echo "email: " . $_POST['email'] . "<br>";
    echo "password: " . $_POST['password'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!--FORMULARIO  -->
<!--si method ="get" en action se manda la informacion a esta misma pagina, cuando pulsas submit-->
<form action="5_Formulario.php" method="post">
    <input name="email" type="email" placeholder="Email..."><br>
    <input name="password" type="password" placeholder="Password..."><br>
    <input type="submit" placeholder="Login..."><br>


</form>
    
</body>
</html>
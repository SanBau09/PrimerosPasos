<?php
session_start();

if(isset($_COOKIE['user'])){
    $_SESSION['user'] = $_COOKIE['user']; //si existe la cookie iniciamos sesion de forma automatica 
    header("Location: pag_personal.php"); 
    die(); 
}

function limpiar_string(string $datos){
    $datos = trim($datos); //quita los caracteres en cblanco del principio y final
    $datos = htmlspecialchars($datos); //convierte los caracteres con sentido para html (<, >, ...)en entidades equivalentes
    return $datos;
}
//Declaramos las variables para que no lleven en los value="" del html la primera vez que entramos
$email = $password ='';
$mensaje_error_email = $mensaje_error_password = '';

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = limpiar_string($_POST['email']);
    $password = limpiar_string($_POST['password']);

    //Comprueba si el email tiene la estructura de un email
    if(filter_var($email,FILTER_VALIDATE_EMAIL) ==false){
        $error = true;
        $mensaje_error_email = "El email no tiene el formato correcto";
    }

    if(empty($email)){
        $error = true;
        $mensaje_error_email = "Debe escribir un email";
    }else{
        $email = $_POST["email"];
    }

    //Comprobaciones del password
    if(empty($password)){
        $error = true;
        $mensaje_error_password = "Debe escribir un password";
    }else{
        $pasword = $_POST["password"];
    }

    if($_POST['email']== 'pepe@gmail.com' && $_POST['password']== '1234'){

        $_SESSION['user'] = "Pepe"; //se crea la variable de sesion
        setcookie('user','Pepe',time()+60+60*24); //creamos la cookie para identificarnos de forma automatica cuando cerremos el ordenador

        header("Location: pag_personal.php"); //Redirige a la pagina 6.registro_completo.php
        die(); //Para la ejecucion para que no siga ejecutandose el resto del código de la página
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .error{
            color: #FF0000;
            font-style: oblique;
        }
    </style>
</head>
<body>
<form action="index.php" method="post">
<input type="email" name="email" placeholder="Email..." value="<?=$email?>"><span class="error">*<?php echo $mensaje_error_email;?></span><br>
<input type="text" name="password" placeholder="Password..." value="<?=$password?>"><span class="error">*<?php echo $mensaje_error_password;?></span><br>
<input type="submit" value="Enviar"><br>
</form>
</body>
</html>
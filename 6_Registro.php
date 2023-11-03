<?php
function limpiar_string(string $datos){
    $datos = trim($datos); //quita los caracteres en cblanco del principio y final
    $datos = htmlspecialchars($datos); //convierte los caracteres con sentido para html (<, >, ...)en entidades equivalentes
    return $datos;
}
//Declaramos las variables para que no lleven en los value="" del html la primera vez que entramos
$nombre = $apellidos = $email = $password = $password2 = '';
$comentarios = $provincia = $genero = $condiciones = '';
$mensaje_error_condiciones = $mensaje_error_email = $mensaje_error_password = $mensaje_error_password2 ='';

//Escribir todos los datos, si el password y el password2 son iguales o no
//si se ha marcado un genero y cual y si se han aceptado las condiciones
if ( $_SERVER['REQUEST_METHOD'] == 'POST'){ //Aquí solo entra cuando se envíe el formulario
    //Limpiamos todos los 
    $nombre = limpiar_string($_POST['nombre']);
    $apellidos = limpiar_string($_POST['apellidos']);
    $email = limpiar_string($_POST['email']);
    $password = limpiar_string($_POST['password']);
    $password2 = limpiar_string($_POST['password2']);
    $comentarios = limpiar_string($_POST['comentarios']);
    $provincia = limpiar_string($_POST['provincia']);
    
    
    if(isset($_POST['genero'])){
            $genero = limpiar_string($_POST['genero']);
        }else{
            $genero = "No indicado";
        }
    
    if (isset($_POST['condiciones'])){
        $condiciones = true;
    }else{
        $condiciones = false;
    }

    print_r($_POST) . " </br>"; //para hacer pruebas rapidas. 
                     //Imprime Array ( [nombre] => [apellidos] => [email] => [password] => [password2] => [comentarios] => [provincia] => Toledo ) 
                     //Los radios y checkbox si no se selecciona nada no se envian datos
    
    /*Comprobar que se han completado los datos obligatorios (email,password y aceptar condiciones)
    Si se han completado todos los obligatorios redirigir a 6.formulario_enviado.php, en caso contrario mantenerse en esta
    página e indicar al lado del campo un mensaje en rojo que indique que es obligatorio
    */
    $error = false;
    
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
    if(strlen($password)<4){
        $error = true;
        $mensaje_error_password = "Debe escribir un password de al menos 4 caracteres";
    }
    if(strlen($password != $password2)){
        $error = true;
        $mensaje_error_password2 = "Los dos password no coinciden " . $password . ", " . $password2;
    }


    if(!$condiciones){
        $error = true;
        $mensaje_error_condiciones = "Debe aceptar las condiciones";
    }else{
        $condiciones = $_POST["condiciones"];
    }

    if(!$error){ //Si no hay error redirige
        header("Location: 6_Registro_Completo.php"); //Redirige a la pagina 6.registro_completo.php
        die(); //Para la ejecucion para que no siga ejecutandose el resto del código de la página
    }

    /*
    echo "Nombre: $nombre <br>";
    echo "Apellidos: $apellidos <br>";
    echo "email: $email<br>";
    if ($password== $password2){
        echo "Las dos contraseñas son iguales: $password" . "<br>";
    }else{
        echo "Las contraseñas no son iguales: $password, $password2" . "<br>";
    }
    echo "genero: $genero<br>";
    echo "Comentarios: $comentarios<br>";
    echo "Provincia: $provincia<br><br><br>";
    */

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
    <form action="6_Registro.php" method="post">
        <input type="text" name="nombre" placeholder="Nombre..." value="<?=$nombre?>"><br>
        <input type="text" name="apellidos" placeholder="Apellidos..." value="<?=$apellidos?>"><br>
        <input type="email" name="email" placeholder="Email..." value="<?=$email?>"><span class="error">*<?php echo $mensaje_error_email;?></span><br>
        <input type="text" name="password" placeholder="Password..." value="<?=$password?>"><span class="error">*<?php echo $mensaje_error_password;?></span><br>
        <input type="text" name="password2" placeholder="Repite Password..." value="<?=$password2?>"><span class="error">*<?php echo $mensaje_error_password2;?></span><br>
        <input type="radio" name="genero" value="femenino" <?php if ($genero=="femenino") echo 'checked'; ?>>Femenino <br>
        <input type="radio" name="genero" value="masculino" <?php if ($genero=="masculino") echo 'checked'; ?>>Masculino <br>
        <input type="checkbox" name="condiciones" <?php if ($condiciones) echo 'checked'; ?>>Acepto las condiciones<span class="error">*<?php echo $mensaje_error_condiciones;?></span><br>
        Comentarios: <br>
        <textarea name="comentarios"><?= $comentarios ?></textarea><br>
        <select name="provincia">
            <option <?php if($provincia=='Toledo') echo 'selected';?>>Toledo</option>
            <option <?php if($provincia=='Ciudad Real') echo 'selected';?>>Ciudad Real</option>
            <option <?php if($provincia=='Guadalajara') echo 'selected';?>>Guadalajara</option>
            <option <?php if($provincia=='Cuenca') echo 'selected';?>>Cuenca</option>
            <option <?php if($provincia=='Albacete') echo 'selected';?>>Albacete</option>
        </select>
        <input type="submit" value="Enviar"><br>
    </form>
</body>
</html>
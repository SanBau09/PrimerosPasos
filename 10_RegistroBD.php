<?php
$password=$password2=$email=$pass_error=$email_error='';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];

    $error = false;

    if($password != $password2){
        $error = true;
        $pass_error = "Las contraseñas no coinciden";
    }

    if(strlen($password)<4){    
        $error = true;
        $pass_error = "Las contraseñas deben tener al menos 4 caracteres";
    }

    if(!$error){ //Si no hay error lo metemos en la BD
        $conn = new mysqli('localhost','root','','blog'); //Conecta con mysql

        if($conn ->connect_error){
            echo "Error al conectar con MySQL: " . $conn->connect_error;
        }

        $sql="Insert into usuarios (email,password) values ('$email', '$password')";

        if(!$conn ->query($sql)){ //Si hay error en la SQL saltaría este fallo
            die("Error al ejecutar la sql " . $conn->error);
        }

        //header('Location: registro_completado.php'); deberiamos hacer esto pero no tenemos creada la página y para probar ponemos solo un mensaje y paramos
        die("Registro Completado");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegistroBD</title>
</head>
<body>
    <form action="10_RegistroBD.php" method="post">
        <input type="email" name="email" placeholder="Email" value="<?= $email ?>"> <span class="error"><?= $email_error ?></span><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="password" name="password2" placeholder="Repite el password"><br>
        <input type="file" name="foto"><br>
        <input type="submit"><br>

    </form>
</body>
</html>
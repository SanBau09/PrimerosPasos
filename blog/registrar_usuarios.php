<?php
    require_once "modelos/connexionDB.php";
    require_once "modelos/usuario.php";
    require_once "modelos/usuariosDAO.php";
    require_once "modelos/config.php";


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //limpiamos los datos 
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $foto = '';

        //Validacion

        //Creamos la conexión usando la clase que hemos creado
        $connexionDB = new connexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST, MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        //Compruebo que no haya un usuario registrado con el mismo email
        $usuariosDAO = new usuariosDAO($conn);

        if($usuariosDAO->getByEmail($email)){
            $error = "Ya hay un usuario con ese email";
        }else{
            //Copiamos la foto al disco

            if($_FILES['foto']['type'] != 'image/jpeg' &&
             $_FILES['foto']['type'] != 'image/png'){
                $error= "la foto no tiene el formato admitido";
            }else{
                //Calculamos el hash para el nombre de archivo
                $nombreArchivo = md5(time()+rand());
                $partes = explode( '.', $_FILES['foto']['name']);
                $extension = $partes[count($partes)-1];
                $foto = $nombreArchivo. '.' . $extension;
                
                //Si existe un archivo con el mismo nombre volvemos a comprobar el hash
                while(file_exists("fotosUsuarios/$foto")){
                    $nombreArchivo = md5(time()+rand());
                    $foto = $nombreArchivo. '.' . $extension;
                }

                move_uploaded_file(($_FILES)['foto']['tmp_name'], "fotosUsuarios/$foto");
            }

            //Insertamos en la BD
            $usuariosDAO = new usuariosDAO($conn);
            $usuario = new usuario();
            $usuario->setEmail($email);

            //encriptamos el password
            $passwordCifrado = password_hash($password, PASSWORD_DEFAULT);
            $usuario->setPassword($passwordCifrado);
            $usuario->setFoto($foto);

            if($usuariosDAO->insert($usuario)){
                header("location: index.php");
            }else{
                $error = "No se ha podido insertar el usuario";
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
    <h1>Registro de Usuarios</h1>
    
    <form action="registrar_usuarios.php" method="post" enctype="multipart/form-data">
        <input type="email" name="email"></br>
        <input type="password" name="password" placeholder="password"></br>
        <input type="file" name="foto" accept="image/jpeg, image/png"></br>
        <input type="submit" value="login">

        <a href="index.php">Volver</a>

    </form>
</body>
</html>
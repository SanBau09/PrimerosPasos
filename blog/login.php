<?php
    session_start();

    require_once "modelos/connexionDB.php";
    require_once "modelos/usuario.php";
    require_once "modelos/usuariosDAO.php";
    require_once "modelos/config.php";
    require_once 'funciones.php';

    //Creamos la conexión usando la clase que hemos creado
    $connexionDB = new connexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST, MYSQL_DB);
    $conn = $connexionDB->getConnexion();

    //Limpiamos los datos que vienen del usuario
    $email = htmlspecialchars(($_POST['email']));
    $password = htmlspecialchars(($_POST['password']));

    //Validamos el usuario
    $usuariosDAO = new usuariosDAO($conn);

    if($usuario = $usuariosDAO->getByEmail($email)){
        if(password_verify($password, $usuario->getPassword())){
            //email y password correctos. iniciar sesion 
          
            $_SESSION['email'] = $usuario->getEmail();
            $_SESSION['foto'] = $usuario->getFoto();
            $_SESSION['id'] = $usuario->getId();

            //Creamos la cookie
            setcookie('email', $usuario->getSid(),time()+24*60*60,'/');
            
            //Redirigimos a index.php
            header('location: index.php');
            die();
        }
    }
    //email o password incorrectos, redirigir a index.php
    guardarMensaje("Email o password incorrectos");
    header('location: index.php');
?>
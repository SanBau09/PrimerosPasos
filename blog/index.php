<?php
    session_start();

    require_once "modelos/connexionDB.php";
    require_once "modelos/mensaje.php";
    require_once "modelos/mensajesDAO.php";
    require_once 'modelos/usuario.php';
    require_once 'modelos/usuariosDAO.php';
    require_once 'funciones.php';

    //Creamos la conexión usando la clase que hemos creado
    $connexionDB = new connexionDB('root','','localhost','blog');
    $conn = $connexionDB->getConnexion();

    //si existe la cookie y no ha iniciado sesión, le iniciamos sesión de forma automática
    if(!isset($_SESSION['email']) && isset($_COOKIE['sid'])){
        //Nos conectamos para obtener el id y la foto de usuario
        $usuariosDAO = new UsuariosDAO($conn);
        //$usuario = $usuariosDAO->getByEmail(($_COOKIE['email']));
        if($usuario = $usuariosDAO->getById(($_COOKIE['sid']))){
            //Inicio sesión
            $_SESSION['email'] = $usuario->getEmail();
            $_SESSION['id'] = $usuario->getId();
            $_SESSION['foto'] = $usuario->getFoto();
        }
    }

    //Creamos el obj mensajeDao para acceder a BBDD a través de este objeto
    $mensajeDAO = new mensajesDao($conn);
    $mensajes = $mensajeDAO->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>

    <style>
        .mensaje{
            margin: 30px auto;
            padding: 5px;
            border: 1px solid black;
            width: 80%;
            position: relative;
        }

        .nuevoMensaje{
            margin: 30px auto;
            padding: 5px;
            border: 1px solid black;
            width: 80%;
            background-color: #00f;
            color: white;
            display: block;
            text-align: center;
            text-decoration: none;
        }

        header{
            margin: 30px auto;
            padding: 5px;
            border: 1px solid black;
            width: 80%;
            display: block;
            text-align: center;

        }

        .titulo{
            font-size: 2em;
        }

        .texto{
            font-size: 1.5em;
        }

        .icono_borrar{
            top: 5px;
            right: 5px;
            position: absolute;
        }

        .icono_editar{
            top: 5px;
            right: 25px;
            position: absolute;
        }

        .color_gris:hover{
            color: black;
        }
        .color_gris{
            color: #aaa;
        }
        .error{
            color: red;
            display: block;
            padding: 10px;
            margin: auto 50px;
            border: 1px solid red;
            text-align: center;
        }
        .fotoUsuario{
            height: 50px;
        }

    </style>
</head>

<body>
    <header>
        <h1>Todos los mensajes</h1> 

        <?php if(isset($_SESSION['email'])): ?>
            <img src="fotosUsuarios/<?= $_SESSION['foto']?>" class="fotoUsuario" alt="">
            <span class="emailUsuario"><?= $_SESSION['email'] ?></span>
            <a href="logout.php">cerrar sesión</a>

        <?php else: ?>
            <form action="login.php" method="post">
                <input type="email" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <input type="submit" value="login">

                <a href="registrar_usuarios.php">Registrar Usuario</a>
            </form>
        <?php endif; ?>
    </header>

    <main>
        <?php
        imprimirMensaje();
        ?>

        <?php foreach ($mensajes as $mensaje):  ?>  <!-- : simula {}  -->
            <div class="mensaje">
                <h4 class="titulo">
                    <a href="ver_mensaje.php?id=<?=$mensaje->getId()?>"><?= $mensaje->getTitulo()?></a>
                </h4>

                <?php if(isset($_SESSION['email']) && $_SESSION['id']== $mensaje->getIdUsuario()): ?>

                    <span class="icono_borrar"><a href="borrar_mensaje.php?id=<?=$mensaje->getId()?>"><i class="fa-solid fa-trash color_gris"></i></a></span>
                    <span class="icono_editar"><a href="editar_mensaje.php?id=<?=$mensaje->getId()?>"><i class="fa-solid fa-pen-to-square color_gris" "></i></a></span>
                <?php endif; ?>

                <p class="texto"><?= $mensaje->getTexto()?></p>     <!--peco y pulsar intro se pone así en vez de con echo -->
            </div>
        <?php  endforeach; ?>

        <?php if(isset($_SESSION['email'])): ?>
            <a class="nuevoMensaje" href="insertar_mensaje.php">Nuevo mensaje</a>
         <?php endif; ?>
        
    </main>

    <script>

    </script>
</body>
</html>





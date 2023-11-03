<?php

//Requires
require_once "modelos/connexionDB.php";
require_once "modelos/mensaje.php";
require_once "modelos/mensajesDAO.php";

//Crear la conexión con la BD
$connexionDB = new connexionDB('root','','localhost','blog');
$conn = $connexionDB->getConnexion();

//Crear MensajesDAO para acceder a BBDD a través de este objeto
$mensajeDAO = new mensajesDao($conn);

//Obtener el mensaje
$idMensaje = htmlspecialchars($_GET['id']);
$mensaje = $mensajeDAO->getById($idMensaje);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .ver_mensaje{
            margin: 10px auto ;
            padding: 5px;
            border: 1px solid black;
            width: 80%;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            min-height: 400px;
        }
        .titulo{
            font-size: 2em;
        }
        .texto{
            font-size: 1.5em;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="ver_mensaje">
        <?php if($mensaje!=null): ?>
            <div class="titulo"><?= $mensaje->getTitulo() ?> </div>
            <div class="texto"><?= $mensaje->getTexto() ?> </div>
            <div class="fecha"><?= $mensaje->getFecha() ?> </div>
        <?php else: ?>
            <strong>Mensaje con id <?= $id ?> no encontrado</strong>
        <?php endif; ?>
        <br><br><br>
        <a href="index.php">Volver al listado de mensajes</a>

    </div>

</body>
</html>
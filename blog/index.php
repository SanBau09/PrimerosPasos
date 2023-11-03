<?php
    require_once "modelos/connexionDB.php";
    require_once "modelos/mensaje.php";
    require_once "modelos/mensajesDAO.php";

    //Creamos la conexión usando la clase que hemos creado
    $connexionDB = new connexionDB('root','','localhost','blog');
    $conn = $connexionDB->getConnexion();

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
    </style>
</head>

<body>
    <header>
        <h1>Todos los mensajes</h1> 
    </header>

    <main>
        <?php foreach ($mensajes as $mensaje):  ?>  <!-- : simula {}  -->
            <div class="mensaje">
                <h4 class="titulo">
                    <a href="ver_mensaje.php?id=<?=$mensaje->getId()?>"><?= $mensaje->getTitulo()?></a>
                </h4>

                <span class="icono_borrar"><a href="borrar_mensaje.php?id=<?=$mensaje->getId()?>"><i class="fa-solid fa-trash color_gris"></i></a></span>
                <span class="icono_editar"><a href="editar_mensaje.php?id=<?=$mensaje->getId()?>"><i class="fa-solid fa-pen-to-square color_gris" "></i></a></span>
                
                <p class="texto"><?= $mensaje->getTexto()?></p>     <!--peco y pulsar intro se pone así en vez de con echo -->
            </div>
        <?php  endforeach; ?>
        
        <a href="insertar_mensaje.php">Nuevo mensaje</a>
    </main>
</body>
</html>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Tareas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="web/css/estilos.css">
</head>
<body>
    <header>
        <h1 class="tituloPagina">Welcome</h1>        
        <span class="emailUsuario"><?= Sesion::getUsuario()->getEmail() ?></span>
        <a href="index.php?accion=logout">cerrar sesión</a>
    </header>
    
    <?php 
        imprimirMensaje();
    ?>
     
    <div id="tareas">
        <?php foreach ($tareas as $tarea): ?>
            <?php
                $idTarea = $tarea->getId();
            ?>
            <div class="tarea">
                <?php if(Sesion::getUsuario() && Sesion::getUsuario()->getId()==$tarea->getIdUsuario()): ?>
                    <div class="texto"><?= $tarea->getTexto() ?></div>
                    <i class="fa-solid fa-trash papelera" data-idTarea="<?= $idTarea?>"></i>
                    <i class="fa-solid fa-circle-check check" data-idTarea="<?= $idTarea?>"></i>
                    <i class="fa-solid fa-pen edit" data-idTarea="<?= $idTarea?>"></i>
                    <img src="web/images/preloader.gif" class="preloaderBorrar">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <input type="text" id="nuevaTarea">
    <button id="botonNuevaTarea">Enviar</button><img src="web/images/preloader.gif" id="preloaderInsertar">

    <script src="web/js/js.js" type="text/javascript"></script>
</body>
</html>
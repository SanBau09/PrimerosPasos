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
    <div class="titulo-y-enlace contenedor">
            <h1 class="tituloPagina">Welcome</h1>        
            <span class="emailUsuario"><?= Sesion::getUsuario()->getEmail() ?></span>
            <a href="index.php?accion=logout">cerrar sesión</a>
        </div>
    </header>
    
    <?php 
        imprimirMensaje();
    ?>
    <div id="contenedorTareas">
        <div id="tareas">
            <?php foreach ($tareas as $tarea): ?>
                <?php
                    $idTarea = $tarea->getId();
                    $texto = $tarea->getTexto();
                    $foto = $tarea->getFoto();
                ?>
                <div class="tarea <?= $tarea->getRealizada() ? 'tarea-realizada' : 'tarea-pendiente' ?>">
                    <?php if(Sesion::getUsuario() && Sesion::getUsuario()->getId()==$tarea->getIdUsuario()): ?>
                        <div id="cajaTexto" class="texto"><?= $texto?></div>
                        <img id="imagenTarea" src="web/fotoTarea/<?=$foto?>" style="height: 100px; border: 1px solid black";>
                        <i id="btnPapelera" class="fa-solid fa-trash papelera" data-idTarea="<?= $idTarea?>"></i>
                        <i id="btnCheck" class="fa-solid fa-circle-check check" data-idTarea="<?= $idTarea?>"></i>
                        <i id="btnElemEdit" class="fa-solid fa-pen elemEdit" data-idTarea="<?= $idTarea?>" data-texto="<?= $texto?>"></i>
                        <img src="web/images/preloader.gif" class="preloaderBorrar">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <input type="text" id="nuevaTarea">
        <button id="botonNuevaTarea">Enviar</button><img src="web/images/preloader.gif" id="preloaderInsertar">
    </div>
    <div id="contenedorEditar">
        <div id="camposEditar">
            <input type="text" class="texto" id="editarTexto" placeholder="Modifica el texto"></br>                    
            <input type="file" id="editarFoto" accept="image/jpeg, image/gif, image/webp, image/png">
            <div id="campoIdTarea" class="campoOculto"></div>
        </div>  
        <button id="botonCancelarEditar">Cancelar</button><img src="web/images/preloader.gif" id="preloaderEditar">
        <button id="botonAceptarEditar">Aceptar</button><img src="web/images/preloader.gif" id="preloaderEditar">              
    </div>

    <script src="web/js/js.js" type="text/javascript"></script>
</body>
</html>
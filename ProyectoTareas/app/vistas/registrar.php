<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="web/css/estilos.css">

    <style>

    </style>
</head>
<body>
    <h1 class="tituloPagina">Registro</h1>
    <?= $error ?>
    <form action="index.php?accion=registrar" method="post" enctype="multipart/form-data">
        <div class="campo">
            <label class="campo__label" for="nombre">Nombre</label>
            <input class="campo__field" type="text" name="nombre" placeholder="Tu Nombre" value="<?= $nombre?>"><br>
        </div> 

        <div class="campo">
            <label class="campo__label" for="email">Email</label>
            <input class="campo__field" type="email" name="email" placeholder="Tu Email" value="<?= $email?>"><br>
            <span class="mensaje_error">* <?= $msje_error_email ?></span><br>
        </div>  

        <div class="campo">
            <label class="campo__label" for="password">Password</label>
            <input class="campo__field"  type="password" name="password" placeholder="Tu Password" value="<?= $password ?>"><br>
            <span class="mensaje_error">* <?= $msje_error_password ?></span><br>
        </div> 

        <div class="campo">
                <input type="submit" value="registrar" class="boton boton--primario derecha"><br>
        </div>

        <a href="index.php">volver</a>
    </form>
</body>
</html>
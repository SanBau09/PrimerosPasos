
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>
    <link rel="stylesheet" href="web/css/estilos.css">
    
</head>

<body>
    <header>
        <h1>Todos los mensajes</h1> 

        <?php if(isset($_SESSION['email'])): ?>
            <img src="fotosUsuarios/<?= $_SESSION['foto']?>" class="fotoUsuario" alt="">
            <span class="emailUsuario"><?= $_SESSION['email'] ?></span>
            <a href="logout.php">cerrar sesión</a>

        <?php else: ?>
            <form action="index.php?accion=login" method="post">
                <input type="email" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <input type="submit" value="login">

                <a href="index.php?accion=registrar">Registrar Usuario</a>
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
                    <a href="index.php?accion=ver_mensaje&id=<?=$mensaje->getId()?>"><?= $mensaje->getTitulo()?></a>
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

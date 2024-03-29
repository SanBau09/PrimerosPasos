<?php
    session_start();


    require_once 'modelos/connexionDB.php';
    require_once 'modelos/mensaje.php';
    require_once 'modelos/mensajesDAO.php';
    require_once 'modelos/usuario.php';
    require_once 'modelos/usuariosDAO.php';
    require_once 'funciones.php';

    if(!isset($_SESSIOn['email'])){
        header("location: index.php");
        guardarMensaje("No puedes mostrar mensajes si no estás logueado");
        die();
    }

    $error ='';

    //Creamos la conexión utilizando la clase que hemos creado
    $connexionDB = new ConnexionDB('root','','localhost','blog');
    $conn = $connexionDB->getConnexion();

    $usuariosDAO = new UsuariosDAO($conn);
    $usuarios = $usuariosDAO->getAll();


    if($_SERVER['REQUEST_METHOD']=='POST'){

        //Limpiamos los datos que vienen del usuario
        $titulo = htmlspecialchars($_POST['titulo']);
        $texto =  htmlspecialchars($_POST['texto']);
        //$idUsuario = htmlspecialchars($_POST['idUsuario']);  solo necesario si queremos seleccionar usuario en el desplegable

        //Validamos los datos
        if(empty($titulo) || empty($texto)){
            $error = "Los dos campos son obligatorios";
        }
        else{
            //Creamos el objeto MensajesDAO para acceder a BBDD a través de este objeto
            $mensajesDAO = new MensajesDAO($conn);
            $mensaje = new Mensaje();
            $mensaje->setTitulo($titulo);
            $mensaje->setTexto($texto);
            //$mensaje->setIdUsuario($idUsuario);
            $mensaje->setIdUsuario($_SESSION['id']); //el id del usuario conectado en la sesion
            $mensajesDAO->insert($mensaje);
            header('location: index.php');
            die();
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
    <?= $error ?>
    
    <form action="insertar_mensaje.php" method="post">
        <input type="text" name="titulo" placeholder="Titulo"><br>
        <textarea name="texto" placeholder="Texto"></textarea><br>
        <!--<select name="idUsuario">
            <?php foreach($usuarios as $usuario): ?>
               <option value="<?= $usuario->getId() ?>"><?= $usuario->getEmail() ?></option>    
            <?php endforeach; ?>
        </select><br> -->
        <input type="submit">
    </form>

</body>
</html>


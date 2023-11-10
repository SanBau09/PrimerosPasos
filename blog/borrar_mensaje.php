<?php
    session_start();

    require_once "modelos/connexionDB.php";
    require_once "modelos/mensaje.php";
    require_once "modelos/mensajesDAO.php";
    require_once 'funciones.php';

    //Creamos la conexión usando la clase que hemos creado
    $connexionDB = new connexionDB('root','','localhost','blog');
    $conn = $connexionDB->getConnexion();

    //Creamos el obj mensajeDao para acceder a BBDD a través de este objeto
    $mensajesDAO = new mensajesDao($conn);

    //Obtener el mensaje
    $idMensaje = htmlspecialchars($_GET['id']);
    $mensaje = $mensajesDAO->getById($idMensaje);
    
    //Comprobamos que mensaje pertenece al usuario conectado
    if($_SESSION['id']== $mensaje->getIdUsuario()){
        $mensajesDAO->delete($idMensaje);
    }else{
        $guardarMensaje("No puedes borrar este mensaje");
    }
  

    header('location: index.php');

?>
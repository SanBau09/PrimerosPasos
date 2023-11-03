<?php
    require_once "modelos/connexionDB.php";
    require_once "modelos/mensaje.php";
    require_once "modelos/mensajesDAO.php";

    //Creamos la conexión usando la clase que hemos creado
    $connexionDB = new connexionDB('root','','localhost','blog');
    $conn = $connexionDB->getConnexion();

    //Creamos el obj mensajeDao para acceder a BBDD a través de este objeto
    $mensajesDAO = new mensajesDao($conn);

    //Obtener el mensaje
    $idMensaje = htmlspecialchars($_GET['id']);

    $mensajesDAO->delete($idMensaje);

    header('location: index.php');

?>
<?php 
require_once 'modelos/Tarea.php';
require_once 'modelos/TareasDAO.php';

$idTarea = htmlentities($_GET['id']);

$tareasDAO = new TareasDAO();
if($tarea = $tareasDAO->borrarTarea($idTarea)){
    print json_encode(['respuesta'=> 'ok']);
}else{
    print json_encode(['respuesta'=> 'error', 'mensake'=>'Tarea no encontrada']);
};

//Simulamos que el servidor tarda 1sg para probar el preloader
sleep(1);
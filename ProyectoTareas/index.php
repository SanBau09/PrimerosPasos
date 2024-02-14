<?php 
require_once 'app/config/config.php';
require_once 'app/modelos/ConnexionDB.php';
require_once 'app/utils/funciones.php';
require_once 'app/modelos/Sesion.php';

require_once 'app/modelos/Tarea.php';
require_once 'app/modelos/TareasDAO.php';
require_once 'app/modelos/Usuario.php';
require_once 'app/modelos/UsuariosDAO.php';
require_once 'app/modelos/Sesion.php';

require_once 'app/controladores/ControladorTareas.php';
require_once 'app/controladores/ControladorUsuarios.php';


//CONTROLADOR FRONTAL

//Uso de variables de sesión
session_start();

//Mapa de enrutamiento
$mapa = array(
    'inicio'=>array("controlador"=>'ControladorUsuarios',
                    'metodo'=>'inicio',
                    'privada'=>false),    
    'login'=>array('controlador'=>'ControladorUsuarios', 
                   'metodo'=>'login', 
                   'privada'=>false),
    'logout'=>array('controlador'=>'ControladorUsuarios', 
                    'metodo'=>'logout', 
                    'privada'=>true),
    'registrar'=>array('controlador'=>'ControladorUsuarios', 
                       'metodo'=>'registrar', 
                       'privada'=>false),
    'tareas'=>array('controlador'=>'ControladorTareas', 
                       'metodo'=>'verTareas', 
                       'privada'=>false),
    'insertar_tarea' => array('controlador' =>'ControladorTareas', 
                       'metodo' =>'insertar',
                       'privada'=>true),
    'borrar_tarea'=>array('controlador'=>'ControladorTareas',
                       'metodo'=>'borrar', 
                       'privada'=>true),   
    'tarea_realizada'=>array('controlador'=>'ControladorTareas',
                       'metodo'=>'hacerCheck', 
                       'privada'=>true),
    'editar_tarea'=>array('controlador'=>'ControladorTareas',
                       'metodo'=>'editar', 
                       'privada'=>true),              
);

//Parseo de la ruta
if(isset($_GET['accion'])){ //Compruebo si me han pasado una acción concreta, sino pongo la accción por defecto inicio
    if(isset($mapa[$_GET['accion']])){  //Compruebo si la accción existe en el mapa, sino muestro error 404
        $accion = $_GET['accion']; 
    }
    else{
        //La acción no existe
        header('Status: 404 Not found');
        echo 'Página no encontrada';
        die();
    }
}else{
    $accion='inicio';   //Acción por defecto
}

//Si existe la cookie y no ha iniciado sesión, le iniciamos sesión de forma automática
//if( !isset($_SESSION['email']) && isset($_COOKIE['sid'])){
if( !Sesion::existeSesion() && isset($_COOKIE['sid'])){
    //Conectamos con la bD
    $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
    $conn = $connexionDB->getConnexion();
    
    //Nos conectamos para obtener el id y la foto del usuario
    $usuariosDAO = new UsuariosDAO($conn);
    if($usuario = $usuariosDAO->getBySid($_COOKIE['sid'])){
        //$_SESSION['email']=$usuario->getEmail();
        //$_SESSION['id']=$usuario->getId();
        //$_SESSION['foto']=$usuario->getFoto();
        Sesion::iniciarSesion($usuario);
    }
    
}

//Si la acción es privada compruebo que ha iniciado sesión, sino, lo echamos a index
// if(!isset($_SESSION['email']) && $mapa[$accion]['privada']){
if(!Sesion::existeSesion() && $mapa[$accion]['privada']){
    header('location: index.php');
    guardarMensaje("Debes iniciar sesión para acceder a $accion");
    die();
}


//$acción ya tiene la acción a ejecutar, cogemos el controlador y metodo a ejecutar del mapa
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

//Ejecutamos el método de la clase controlador
$objeto = new $controlador();

// El método editar necesita tres parámetros para poder ser ejecutado
if(isset($_GET['idTarea']) && isset($_GET['textoTarea'])){
    $objeto->$metodo($_GET['idTarea'], $_GET['textoTarea']);
} else{
    //Como hay métodos que requieren del idTarea para ejecutarse, hay que recoger el idTarea de los parámetros de la URL
    if(isset($_GET['idTarea'])){        
        $objeto->$metodo($_GET['idTarea']);
    }else{
        $objeto->$metodo();
    }
}

?>
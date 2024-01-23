<?php
session_start();

require_once 'app/config/config.php';
require_once 'app/modelos/connexionDB.php';
require_once 'app/modelos/mensaje.php';
require_once 'app/modelos/mensajesDAO.php';
require_once 'app/modelos/usuario.php';
require_once 'app/modelos/usuariosDAO.php';
require_once 'app/modelos/Favorito.php';
require_once 'app/modelos/FavoritosDAO.php';
require_once 'app/controladores/ControladorMensajes.php';
require_once 'app/controladores/ControladorUsuarios.php';
require_once 'app/controladores/ControladorFavoritos.php';
require_once 'app/utils/funciones.php';

 //Mapa de enrutamiento
 $mapa = array(
    //'posicion' => 'valor'
    'inicio' => array('controlador' =>'ControladorMensajes',
                      'metodo' =>'inicio', 
                      'privada'=>false),
    'ver_mensaje' => array('controlador' =>'ControladorMensajes', 
                           'metodo' =>'ver',
                           'privada'=>false),
    'insertar_mensaje' => array('controlador' =>'ControladorMensajes', 
                                'metodo' =>'insertar',
                                'privada'=>true),
    'borrar_mensaje' => array('controlador' =>'ControladorMensajes',
                              'metodo' =>'borrar',
                              'privada'=>true),
    'editar_mensaje' => array('controlador' =>'ControladorMensajes',
                              'metodo' =>'editar',
                              'privada'=>true),
    'login' => array('controlador' =>'ControladorUsuarios',
                    'metodo' =>'login',
                    'privada'=>false),
    'logout' => array('controlador' =>'ControladorUsuarios',
                      'metodo' =>'logout',
                      'privada'=>true),
    'registrar' => array('controlador' =>'ControladorUsuarios',
                         'metodo' =>'registrar',
                         'privada'=>false),
    'insertar_favorito'=>array('controlador'=>'ControladorFavoritos', 
                         'metodo'=>'insertar', 
                         'privada'=>false),
    'borrar_favorito'=>array('controlador'=>'ControladorFavoritos', 
                         'metodo'=>'borrar', 
                         'privada'=>false)
);


// Parseo de la ruta
if (isset($_GET['accion'])) { //compruebo si me han pasado una acción concreta sino pongo la acción por defecto

    if(isset($mapa[$_GET['accion']])){ //compruebo si la accion existe en el mapa, sino muestro error 404
        $accion = $_GET['accion']; 
    }else{
        //La accion no existe
        header('Status: 404 Not Found');
        echo 'Página no encontrada';
        die();
    }
} else {
    $accion = 'inicio'; //accion por defecto
}

//Si existe la cookie y no ha iniciado sesión, iniiamos sesion de forma automática
if(!isset($_SESSION['email']) && isset($_COOKIE['sid'])){

    //Creamos la conexión usando la clase que hemos creado
    $connexionDB = new connexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);

     //si existe la cookie y no ha iniciado sesión, le iniciamos sesión de forma automática
     if(!isset($_SESSION['email']) && isset($_COOKIE['sid'])){
        //Nos conectamos para obtener el id y la foto de usuario
        $usuariosDAO = new UsuariosDAO($conn);
        //$usuario = $usuariosDAO->getByEmail(($_COOKIE['email']));
        if($usuario = $usuariosDAO->getById(($_COOKIE['sid']))){
            //Inicio sesión
            $_SESSION['email'] = $usuario->getEmail();
            $_SESSION['id'] = $usuario->getId();
            $_SESSION['foto'] = $usuario->getFoto();
        }
    }
}

//Si la accion es privada compruebo que ha iniciado sesion, sino, lo echamos a index

if(!isset($_SESSION['email']) && $mapa[$accion]['privada']){
    header('location: index.php');
    guardarMensaje("Debes iniciar sesion para acceder a $accion");
    die();
}

//$accion ya tiene la accion a ejecutar, cogemos el controlador y metodo a ejecutar del mapa
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

//Ejecutamos el método de la clase controlador
$objeto = new $controlador(); //crea una clase del metodo que contenga esa variable
$objeto->$metodo();

?>


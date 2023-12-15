<?php
session_start();

require_once 'app/config/config.php';
require_once 'app/modelos/connexionDB.php';
require_once 'app/modelos/mensaje.php';
require_once 'app/modelos/mensajesDAO.php';
require_once 'app/modelos/usuario.php';
require_once 'app/modelos/usuariosDAO.php';
require_once 'app/controladores/ControladorMensajes.php';
require_once 'app/controladores/ControladorUsuarios.php';
require_once 'app/utils/funciones.php';

//uso de variables de sesion


 //Mapa de enrutamiento
 $mapa = array(
    //'posicion' => 'valor'
    'inicio' => array('controlador' =>'ControladorMensajes', 'metodo' =>'inicio'),
    'ver_mensaje' => array('controlador' =>'ControladorMensajes', 'metodo' =>'ver'),
    'insertar_mensaje' => array('controlador' =>'ControladorMensajes', 'metodo' =>'insertar'),
    'borrar_mensaje' => array('controlador' =>'ControladorMensajes', 'metodo' =>'borrar'),
    'editar_mensaje' => array('controlador' =>'ControladorMensajes', 'metodo' =>'editar'),
    'login' => array('controlador' =>'ControladorUsuarios', 'metodo' =>'login'),
    'logout' => array('controlador' =>'ControladorUsuarios', 'metodo' =>'logout'),
    'registrar' => array('controlador' =>'ControladorUsuarios', 'metodo' =>'registrar')
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

//$accion ya tiene la accion a ejecutar, cogemos el controlador y metodo a ejecutar del mapa
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

//Ejecutamos el método de la clase controlador
$objeto = new $controlador(); //crea una clase del metodo que contenga esa variable
$objeto->$metodo();

?>


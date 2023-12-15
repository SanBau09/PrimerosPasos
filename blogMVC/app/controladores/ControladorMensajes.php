<?php
class ControladorMensajes{

    public function ver(){
        //Crear la conexión con la BD
        $connexionDB = new connexionDB('root','','localhost','blog');
        $conn = $connexionDB->getConnexion();

        //Crear MensajesDAO para acceder a BBDD a través de este objeto
        $mensajeDAO = new mensajesDao($conn);

        //Obtener el mensaje
        $idMensaje = htmlspecialchars($_GET['id']);
        $mensaje = $mensajeDAO->getById($idMensaje);

        //Incluyo la vista
        require 'app/vistas/ver_mensaje.php';
    }
        
    public function inicio(){
        //Creamos la conexión usando la clase que hemos creado
        $connexionDB = new connexionDB('root','','localhost','blog');
        $conn = $connexionDB->getConnexion();

        //Creamos el obj mensajeDao para acceder a BBDD a través de este objeto
        $mensajeDAO = new mensajesDao($conn);
        $mensajes = $mensajeDAO->getAll();

        //Incluyo la vista
        require 'app/vistas/inicio.php';

    }
        
    public function borrar(){
        print "Borrar";
    }
        
    public function editar(){
        print "Editar";
    }
        
    public function insertar(){
        print "Insertar";
    }
}

?>
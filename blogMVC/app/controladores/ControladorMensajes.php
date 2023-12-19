<?php
class ControladorMensajes{

    public function ver(){
        //Crear la conexión con la BD
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
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
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        //Creamos el obj mensajeDao para acceder a BBDD a través de este objeto
        $mensajeDAO = new mensajesDao($conn);
        $mensajes = $mensajeDAO->getAll();

        //Incluyo la vista
        require 'app/vistas/inicio.php';

    }
        
    public function borrar(){
       //Creamos la conexión usando la clase que hemos creado
       $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
       $conn = $connexionDB->getConnexion();

        //Creamos el obj mensajeDao para acceder a BBDD a través de este objeto
        $mensajeDAO = new mensajesDao($conn);

        //Obtener el mensaje
        $idMensaje = htmlspecialchars($_GET['id']);
        $mensaje = $mensajeDAO->getById($idMensaje);

        //Comprobamos que mensaje pertenece al usuario conectado
        if($_SESSION['id']== $mensaje->getIdUsuario()){
        $mensajeDAO->delete($idMensaje);
        }
        else{
            guardarMensaje("No puedes borrar este mensaje");
        }

        header('location: index.php');

    }
        
    public function editar(){
        $error ='';

        //Creamos la conexión usando la clase que hemos creado
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        //Obtengo el id del mensaje que viene por GET
        $idMensaje = htmlspecialchars($_GET['id']);

        //Obtengo el mensaje de la BD
        $mensajeDAO = new mensajesDAO($conn);
        $mensaje = $mensajeDAO->getById($idMensaje);

        //Obtengo el usuario de la BD
        $usuariosDAO = new UsuariosDAO($conn);
        $usuarios = $usuariosDAO->getAll();

        //Cuando se envíe el formulario actualizo el mensaje en la BD
        if($_SERVER['REQUEST_METHOD']=='POST'){

        //Limpiamos los datos que vienen del usuario
        $titulo = htmlspecialchars($_POST['titulo']);
        $texto = htmlspecialchars($_POST['texto']);
        $idUsuario = htmlspecialchars($_POST['idUsuario']);
        }

        //Validamos los datos
        if(empty($titulo) || empty($texto)){
            $error = "Los dos campos son obligatorios";
        }else{
            $mensaje->setTitulo($titulo);
            $mensaje->setTexto($texto);
            $mensaje->setIdUsuario($idUsuario);

            if($mensajeDAO->update($mensaje)){
                header('location:index.php');
                die();
            }
        }
        require 'app/vistas/editar_mensaje.php';
    }

    public function insertar(){
        
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
        require 'app/vistas/insertar_mensaje.php';
    }
}

?>
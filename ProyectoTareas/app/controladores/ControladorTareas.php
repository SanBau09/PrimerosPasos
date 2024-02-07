<?php 

class ControladorTareas{

    public function verTareas(){

        // Obtener el ID del usuario que ha iniciado sesión
        $idUsuario = Sesion::getUsuario()->getId();

        //Creamos la conexión utilizando la clase que hemos creado
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        //Creamos el objeto TareasDAO para acceder a BBDD a través de este objeto
        $tareasDAO = new TareasDAO($conn);

        $tareas = $tareasDAO->obtenerTodasLasTareasPorUsuario($idUsuario);
        //Incluyo la vista
        require 'app/vistas/tareas.php';
    }

    public function insertar(){
        // Verificar si se envió un formulario POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Limpiar el texto de la tarea
            $texto =  htmlspecialchars($_POST['texto']);
        
            // Validar que el texto no esté vacío
            if(empty($texto)){
                // Manejar el error
                $error = "El campo es obligatorio";
            } else {
                // Crear la conexión utilizando la clase que hemos creado
                $connexionDB = new ConnexionDB(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
                $conn = $connexionDB->getConnexion();
        
                // Crear un objeto TareasDAO para acceder a la base de datos
                $tareasDAO = new TareasDAO($conn);
                $idUsuario = Sesion::getUsuario()->getId();

                // Insertar la tarea en la base de datos
                $tarea = $tareasDAO->insertarTarea($texto, $idUsuario);

                if($tarea){
                    print $tarea->toJSON();

                    //Simulamos que el servidor tarda 1sg para probar el preloader
                    sleep(1);
                } else {
                    // Manejar el error si la inserción falla
                    $error = "No se ha podido insertar la tarea";
                }
            }
        }
    }

    public function borrar($idTarea){

        //Creamos la conexión utilizando la clase que hemos creado
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $tareasDAO = new TareasDAO();
        if($tarea = $tareasDAO->borrarTarea($idTarea)){
            print json_encode(['respuesta'=>'ok']);
        }else{
            print json_encode(['respuesta'=>'error', 'mensaje'=>'Tarea no encontrada']);
        }

        //paramos la ejecución 1sg para simular que el servidor tarda 1sg en responder
        sleep(1);
    }
}

?>
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

    public function hacerCheck($idTarea){
        // Realizar la actualización en la base de datos
        $connexionDB = new ConnexionDB(MYSQL_USER, MYSQL_PASS, MYSQL_HOST, MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $tareasDAO = new TareasDAO($conn);

         // Obtener la tarea por su ID
        $tarea = $tareasDAO->obtenerTareaPorId($idTarea);
        $estaRealizada = $tarea->getRealizada();
        if ($estaRealizada == 0){
            $tareasDAO->marcarTareaComoRealizada($idTarea, 1);
        } else {
            $tareasDAO->marcarTareaComoRealizada($idTarea, 0);
        }

        print  json_encode(['respuesta'=>'ok']); //ESTO PARA LA RESPUESTA DEL SERVIDOR
    }

    public function editar($idTarea, $nuevoTexto){
        //Conectamos con la bD
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        // Crear un objeto TareasDAO para acceder a la base de datos
        $tareasDAO = new TareasDAO();

        $nuevaFoto = htmlentities($_FILES['fotoTarea']['name']);
        
        // Obtener la tarea por su ID
        $tarea = $tareasDAO->obtenerTareaPorId($idTarea);

        // Verificar si la tarea existe
        if ($tarea) {
            // Actualizar el texto de la tarea si se proporciona
            if (!empty($nuevoTexto)) {
                $tarea->setTexto($nuevoTexto);
            }

            // Actualizar la foto de la tarea si se proporciona
            if (!empty($nuevaFoto)) {

                if($_FILES['fotoTarea']['type'] != 'image/jpeg' &&
                $_FILES['fotoTarea']['type'] != 'image/webp' &&
                $_FILES['fotoTarea']['type'] != 'image/png'){

                    print  json_encode(['respuesta'=>'error', 'mensaje'=>'La foto no tiene el formato admitido, debe ser jpg, png o webp']);
                } else{

                    $informacionPath = pathinfo($nuevaFoto);
                    $extension = $informacionPath['extension'];
                    $nombreArchivo = md5(time()+rand()) . '.' . $extension;
                    move_uploaded_file($_FILES['fotoTarea']['tmp_name'],"web/fotoTarea/$nombreArchivo");   
                    
                    // Se borra la anterior foto
                    $fotoAnterior = $tarea->getFoto();
                    if (!empty($fotoAnterior) && file_exists("web/fotoTarea/".$fotoAnterior)){
                        unlink("web/fotoTarea/".$fotoAnterior);
                    }

                    $tarea->setFoto($nombreArchivo);
                }
            }

            // Actualizar la tarea en la base de datos
            if ($tareasDAO->update($tarea)) {
                // Tarea actualizada correctamente
                print json_encode(['respuesta'=>'ok', 'texto'=>$tarea->getTexto(), 'foto'=>$tarea->getFoto()]); //ESTO PARA LA RESPUESTA DEL SERVIDOR
            } else {
                // Error al actualizar la tarea
                print  json_encode(['respuesta'=>'error']);
            }
        } else {
            // La tarea no existe
            print  json_encode(['respuesta'=>'error']);
        }        
    }
}

?>
<?php 

class ControladorTareas{

    public function verTareas(){

        //Creamos la conexión utilizando la clase que hemos creado
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        //Creamos el objeto TareasDAO para acceder a BBDD a través de este objeto
        $tareasDAO = new TareasDAO($conn);
        $tareas = $tareasDAO->obtenerTodasLasTareas();
        //Incluyo la vista
        require 'app/vistas/tareas.php';
    }
}

?>
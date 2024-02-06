<?php

class TareasDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli("localhost", "root", "", "tareas");

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function obtenerTodasLasTareas() {
        $query = "SELECT * FROM tareas";
        $resultados = $this->conexion->query($query);
        $tareas = array();

        if ($resultados->num_rows > 0) {
            while ($tarea = $resultados->fetch_object(Tarea::class)) {
                $tareas[] = $tarea;
            }
        }

        return $tareas;
    }

    public function insertarTarea($texto, $fecha, $foto, $realizada) {
        // Preparar la consulta SQL con marcadores de posición (?)
        $query = "INSERT INTO tareas (texto, fecha, foto, realizada, idUsuario) VALUES (?, ?, ?, 0, ?)";
        $stmt = $this->conexion->prepare($query);   // Preparar la sentencia
    
        // Vincular los parámetros
        $stmt->bind_param("sssii", $texto, $fecha, $foto, $realizada, $idUsuario);
    
        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Obtener el ID insertado
            $idInsertado = $stmt->insert_id;
            $nuevaTarea = $this->obtenerTareaPorID($idInsertado); // Obtener la tarea recién insertada
    
            $stmt->close(); // Cerrar la sentencia
            return $nuevaTarea;
        } else {  // Manejar errores o devolver null
            $stmt->close();
            return null;
        }
    }

    public function obtenerTareaPorID($id) {
        $query = "SELECT * FROM tareas WHERE id = $id";
        $resultado = $this->conexion->query($query);

        if ($resultado->num_rows > 0) {
            $tarea = $resultado->fetch_object(Tarea::class);
            
            return $tarea;
        } else {
            return null;
        }
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }


    public function borrarTarea($id) {
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        $query = "delete from tareas where id=$id";
        
        $this->conexion->query($query);
        if($this->conexion->affected_rows==1){
            return true;
        } else {
            return false;
        }
    }
}
?>

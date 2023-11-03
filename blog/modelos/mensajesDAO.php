<?php
require_once 'mensaje.php';

class MensajesDAO {
    private mysqli $conn; //propiedad que se va a usar en el resto de la clase

    public function __construct($conn){
        $this->conn = $conn;
    }  
    
    public function getById($id):Mensaje|null{
        // $this->conn->prepare() devuelve un objeto stmt de la clase mysqli_stmt
        if(!$stmt = $this->conn->prepare("SELECT * FROM mensajes WHERE id = ?")){ 
            echo "Error en la SQL: " . $this->conn->error; 
        }
        
        $stmt->bind_param('i', $id); //bind_param asocia cada ? con una variable
        $stmt->execute(); //ejecutamos la sql
        $result = $stmt->get_result(); //obtener el objeto mysql_result

        //Si ha encontrado algún resultado devolvemos un objeto de la clase Mensaje, sino null
        if($result->num_rows == 1){
            $mensaje = $result->fetch_object(Mensaje::class);
            return $mensaje;
        }else{
            return null;
        }   
    }   
    
    //OBTIENE TODOS LOS MENSAJES DE LA TABLA MENSAJES
    public function getAll():array{
       
        if(!$stmt = $this->conn->prepare("SELECT * FROM mensajes")){ 
            echo "Error en la SQL: " . $this->conn->error; 
        }
        
        $stmt->execute(); //ejecutamos la sql
        $result = $stmt->get_result(); //obtener el objeto mysql_result

        $array_mensajes = array();
        
        while($mensaje= $result->fetch_object(Mensaje::class)){
            $array_mensajes[] = $mensaje;
        } 
        return $array_mensajes; //Devuelve un array de objetos Mensaje
    }   

    /*
    Borra el mensaje de la tabla mensajes del id pasado por parametro
    @return true si ha borrado el mensaje y false si no lo ha borrado (porque no existía)
    */ 
    function delete($id): bool{
        if(!$stmt = $this->conn->prepare("DELETE FROM mensajes WHERE id=?")){
            echo "Error en la SQL: " . $this->conn->error;
        }
        
        $stmt->bind_param('i',$id); //Asociar las variables a las ? 
        $stmt->execute();   //Ejecutamos la SQL

        //Comprobamos si ha borrado o no algún registro
        if($stmt->affected_rows==1){
            return true;
        }else{
            return false;
        }
    }
    /*
    Insertar el mensaje que recibe como parámetro
    @return
    */ 
     /**
     * Inserta en la base de datos el mensaje que recibe como parámetro
     * @return idMensaje Devuelve el id autonumérico que se le ha asignado al mensaje o false en caso de error
     */
    function insert(Mensaje $mensaje): int|bool{
        if(!$stmt = $this->conn->prepare("INSERT INTO mensajes (titulo, texto, idUsuario) VALUES (?,?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }
        $titulo = $mensaje->getTitulo();
        $texto = $mensaje->getTexto();
        $idUsuario = $mensaje->getIdUsuario();
        $stmt->bind_param('ssi',$titulo, $texto, $idUsuario);
        if($stmt->execute()){
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    }

    //FUNCION EDITAR
    function update($mensaje){
        if(!$stmt = $this->conn->prepare("UPDATE mensajes SET titulo=?, texto=?, idUsuario=? WHERE id=?")){
            die("Error al preparar la consulta update: " . $this->conn->error );
        }

        $titulo = $mensaje->getTitulo();
        $texto = $mensaje->getTexto();
        $idUsuario = $mensaje->getIdUsuario();
        $id = $mensaje->getId();
    
        $stmt->bind_param('ssii',$titulo, $texto, $idUsuario, $id);
        return $stmt->execute();
    }

}
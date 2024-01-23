<?php
class FavoritosDAO{
    private mysqli $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function insert($favorito){
        if(!$stmt = $this->conn->prepare("INSERT INTO favoritos (idMensaje, idUsuario) VALUES (?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }
        $idMensaje = $favorito->getIdMensaje();
        $idUsuario = $favorito->getIdUsuario();
        $stmt->bind_param('ii',$idMensaje, $idUsuario);
        if($stmt->execute()){
            $favorito->setId($stmt->insert_id);
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    }

    public function delete($favorito){
        if(!$stmt = $this->conn->prepare("DELETE FROM favoritos WHERE id = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $id = $favorito->getId();
        $stmt->bind_param('i',$id);
 
        //Comprobamos si ha borrado algún registro o no
        if($stmt->affected_rows==1){
            return true;
        }
        else{
            return false;
        }

    }
    public function countByIdMensaje($idMensaje){
        if(!$stmt = $this->conn->prepare("SELECT count(*) as NumFavoritos FROM favoritos WHERE idMensaje = ?"))
        {
            echo "Error en la SQL: " . $this->conn->error;
        }
        //Asociar las variables a las interrogaciones(parámetros)
        $stmt->bind_param('i',$idMensaje);
        $result = $stmt->get_result();
        $fila = $result->fetch_assoc();

        return $fila['NumFavoritos'];
        

    }
}
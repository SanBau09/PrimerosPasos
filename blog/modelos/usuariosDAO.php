<?php

    class UsuariosDAO {
        private mysqli $conn; //propiedad que se va a usar en el resto de la clase

        public function __construct($conn) {
            $this->conn = $conn;
        }

        /**
         * Obtiene un usuario de la BD en función del id
         * @return Usuario Devuelve un Objeto de la clase Usuario
         */
        public function getById($id):Usuario|null {
            return null;
        }

        //OBTIENE TODOS LOS USUARIOS DE LA TABLA USUARIOS
        public function getAll():array {
            if(!$stmt = $this->conn->prepare("SELECT * FROM usuarios")){
                echo "Error en la SQL: " . $this->conn->error;
            }
           
            $stmt->execute();     //Ejecutamos la SQL
            $result = $stmt->get_result();  //Obtener el objeto mysql_result

            $array_mensajes = array();
            
            while($usuario = $result->fetch_object(Usuario::class)){
                $array_usuarios[] = $usuario;
            }
            return $array_usuarios;
        }


        /**
         * BORRA EL USUARIO de la tabla usuarios del id pasado por parámetro
         * @return true si ha borrado el usuario y false si no lo ha borrado (por que no existia)
         */
        function delete($id):bool{
            if(!$stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id=?")){
                echo "Error en la SQL: " . $this->conn->error;
            }
                       
            $stmt->bind_param('i',$id);   //Asociar las variables a las ? 
            $stmt->execute();          //Ejecutamos la SQL

            //Comprobamos si ha borrado o no algún registro
            if($stmt->affected_rows==1){
                return true;
            }else{
                return false;
            }
        }

        /**
         * INSERTA en la base de datos el usuario que recibe como parámetro
         * @return idUsuario Devuelve el id autonumérico que se le ha asignado al usuario o false en caso de error
         */
        function insert(Usuario $usuario): int|bool{
            if(!$stmt = $this->conn->prepare("INSERT INTO usuarios (email, password, foto) VALUES (?,?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
            }

            $email = $usuario->getEmail();
            $password = $usuario->getPassword();
            $foto = $usuario->getFoto();
            $stmt->bind_param('ssi',$email, $password, $foto);
            if($stmt->execute()){
                return $stmt->insert_id;
            }
            else{
                return false;
            }
        }
    }
?>
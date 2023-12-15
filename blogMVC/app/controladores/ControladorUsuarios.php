<?php
class ControladorUsuarios{

    public function registrar(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //limpiamos los datos 
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            $foto = '';
    
            //Validacion
    
            //Creamos la conexión usando la clase que hemos creado
            $connexionDB = new connexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST, MYSQL_DB);
            $conn = $connexionDB->getConnexion();
    
            //Compruebo que no haya un usuario registrado con el mismo email
            $usuariosDAO = new usuariosDAO($conn);
    
            if($usuariosDAO->getByEmail($email)){
                $error = "Ya hay un usuario con ese email";
            }else{
                //Copiamos la foto al disco
    
                if($_FILES['foto']['type'] != 'image/jpeg' &&
                 $_FILES['foto']['type'] != 'image/png'){
                    $error= "la foto no tiene el formato admitido";
                }else{
                    //Calculamos el hash para el nombre de archivo
                    $nombreArchivo = md5(time()+rand());
                    $partes = explode( '.', $_FILES['foto']['name']);
                    $extension = $partes[count($partes)-1];
                    $foto = $nombreArchivo. '.' . $extension;
                    
                    //Si existe un archivo con el mismo nombre volvemos a comprobar el hash
                    while(file_exists("web/fotosUsuarios/$foto")){
                        $nombreArchivo = md5(time()+rand());
                        $foto = $nombreArchivo. '.' . $extension;
                    }
    
                    move_uploaded_file(($_FILES)['foto']['tmp_name'], "web/fotosUsuarios/$foto");
                }
    
                //Insertamos en la BD
                $usuariosDAO = new usuariosDAO($conn);
                $usuario = new usuario();
                $usuario->setEmail($email);
    
                //encriptamos el password
                $passwordCifrado = password_hash($password, PASSWORD_DEFAULT);
                $usuario->setPassword($passwordCifrado);
                $usuario->setFoto($foto);
                $usuario->setSid(sha1(rand()+time()), true);
    
                if($usuariosDAO->insert($usuario)){
                    header("location: index.php");
                }else{
                    $error = "No se ha podido insertar el usuario";
                }
            }
        }
        require 'app/vistas/registrar.php';
    }

    public function login(){
    //Creamos la conexión usando la clase que hemos creado
    $connexionDB = new connexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST, MYSQL_DB);
    $conn = $connexionDB->getConnexion();

    //Limpiamos los datos que vienen del usuario
    $email = htmlspecialchars(($_POST['email']));
    $password = htmlspecialchars(($_POST['password']));

    //Validamos el usuario
    $usuariosDAO = new usuariosDAO($conn);

    if($usuario = $usuariosDAO->getByEmail($email)){
        if(password_verify($password, $usuario->getPassword())){
            //email y password correctos. iniciar sesion 
          
            $_SESSION['email'] = $usuario->getEmail();
            $_SESSION['foto'] = $usuario->getFoto();
            $_SESSION['id'] = $usuario->getId();
            
            //Redirigimos a index.php
            header('location: index.php');
            die();
        }
    }
    //email o password incorrectos, redirigir a index.php
    guardarMensaje("Email o password incorrectos");
    header('location: index.php');
    }

    public function logout(){
        session_start();
        session_unset(); //Borra todas las variables de sesión
        
        header('location: index.php');
    }
}

?>
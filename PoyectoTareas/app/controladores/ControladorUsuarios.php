<?php 

Class ControladorUsuarios{

    public function inicio(){
        require 'app/vistas/inicio.php';
    }

    public function login(){
        //Creamos la conexión utilizando la clase que hemos creado
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        //limpiamos los datos que vienen del usuario
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        //Validamos el usuario
        $usuariosDAO = new UsuariosDAO($conn);
        if($usuario = $usuariosDAO->getByEmail($email)){
            if(password_verify($password, $usuario->getPassword()))
            {
                //email y password correctos. Inciamos sesión
                Sesion::iniciarSesion($usuario);
        
                //Creamos la cookie para que nos recuerde 1 semana
                setcookie('sid',$usuario->getSid(),time()+24*60*60,'/');
                
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
        Sesion::cerrarSesion();
        setcookie('sid','',0,'/');
        header('location: index.php');
    }

    public function registrar(){
        //Declaramos las variables para que no fallen en los value="" del html la primera vez que entramos
        $email = $password = $nombre = '';
        $error= $msje_error_email = $msje_error_password = '';

        if($_SERVER['REQUEST_METHOD']=='POST'){

            //Limpiamos los datos
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            $nombre = htmlentities($_POST['nombre']);

            //Validación 
            $error = false;

            //Comprobar si el email es un email de verdad
            if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
                $error = true;
                $msje_error_email = "El email no tiene el formato correcto";
            }
            //Comprobar si el email esta vacío
            if(empty($email)){
                $error = true;
                $msje_error_email = "Debe escribir un email";
            }
            //Comprobar que el password tiene al menos 4 caracteres
            if(strlen($password)<4){
                $error = true;
                $msje_error_password = "Debe escribir un password de al menos 4 caracteres";        
            }

            //Conectamos con la BD
            $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
            $conn = $connexionDB->getConnexion();

            //Compruebo que no haya un usuario registrado con el mismo email
            $usuariosDAO = new UsuariosDAO($conn);

            if($usuariosDAO->getByEmail($email) != null){
            $error = "Ya hay un usuario con ese email";
            }

            if($error == ''){    //Si no hay error

                //Insertamos en la BD un nuevo usuario
                $usuario = new Usuario();
    
                //se establecen sus propiedades con los datos del formulario
                $usuario->setSid(sha1(rand()+time()), true);
                $usuario->setEmail($email);
                //encriptamos el password
                $passwordCifrado = password_hash($password,PASSWORD_DEFAULT);
                $usuario->setPassword($passwordCifrado);
                $usuario->setNombre($nombre);
    
                if($usuariosDAO->insert($usuario)){
                    header("location: index.php");
                    die();
                }else{
                    $error = "No se ha podido insertar el usuario";
                }
            }
    
        }   //Acaba if($_SERVER['REQUEST_METHOD']=='POST'){...}

        require 'app/vistas/registrar.php';

    }   // Acaba function registrar()
    
}
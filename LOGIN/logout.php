<?php 
session_start();

//Borramos la variable de sesion y volvemos al index
unset($_SESSION['user']);

setcookie('user','',time()-5);//Borra la cookie a los 5 segundos. Esto se hace para que pueda usarse el enlace cerrar sesion y redireccionarte al index
header("Location: index.php"); 

?>
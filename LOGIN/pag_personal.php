<?php
session_start();
//si no existe la variable de sesion es que no se ha identificado
if(!isset($_SESSION['user'])){
    header("Location: index.php"); 
    die(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido a tu página <?=$_SESSION['user'] ?></h1>
    <a href="logout.php">Cerrar sesion</a>
</body>
</html>
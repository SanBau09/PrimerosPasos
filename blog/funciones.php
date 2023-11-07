<?php

function generarNombreArchivo (String $nombreOriginal):string{
    $nuevoNombre = md5(time()+rand());
    $partes = explode( '.', $_FILES['foto']['name']);
    $extension = $partes[count($partes)-1];
    return $nuevoNombre. '.' .$extension;

}
?>
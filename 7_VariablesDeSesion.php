<?php
session_start();

if(!isset($variable)){
    $variable = 5;
}else{
    $variable++;
}

echo "\$variable:  $variable" . "<br>";

/*VARIABLES DE SESION --> mantienen su valor aunque recarguemos la pagina y en otras paginas del sitio
                          hasta que cerramos el navegador, en ese momento se eliminan
*/
if(!isset($_SESSION['variable'])){
    $_SESSION['variable'] = 5;
}else{
    $_SESSION['variable']++;
}

echo '$_SESSION[variable]: ' . $_SESSION['variable']. "<br>";

/*COOKIES --> guarda un nombre y un valor en el ordenador del cliente.
              Cuando el cliente vuelve a entrar en la misma página se la envía al servidor
*/
//setcookie("usuario","pepe",time()+60*60*24); //caduca en 1 día (60s 60min 24h)

if(!isset($_COOKIE['numero'])){
    setcookie("numero","5",time()+60*60*24);
    echo "Se ha creado una cookie en el cliente con el nombre numero y valor 5";
}else{
    setcookie("numero",$_COOKIE['numero']+1,time()+60*60*24);
    echo "Se ha actualizado la cookie al valor " . $_COOKIE['numero']+1;
}
//"La cookie numero tiene el valor $_COOKIE[numero] <br";
?>
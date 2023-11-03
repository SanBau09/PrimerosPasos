<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Introduccion PHP</h1>
        <?php
        echo "Hola". "</br>";

        //esto es un comentario
        for($i=0;$i<=10;$i++){
            echo  $i . "</br>";
        }
        
        $num = 5;
        $dec = 3.4;
        echo var_dump($num) . "</br>" ;//var_dump te dice de que tipo es la variable
        echo var_dump($dec). "</br>" ;

        echo "El valor de la variable \"dec\" es $dec" . "</br>";

        //CONSTANTES (DEFINE)
        define ("MYSQL_USER", "root"); //se utiliza para parámetros de configuración
        echo MYSQL_USER. "</br>"; //imprime root

        //____OPERACIONES CON STRING____

        echo strlen("Hello world!"). "</br>"; // muestra en pantalla el num de letras 12
        echo str_word_count("Hello world!"). "</br>"; // Muestra por pantalla el num de palabras 2
        echo strrev("Hello world!"). "</br>"; // devuelve la cadena al revés !dlrow olleH

        //separar la variable nombreCompleto y guardar en $nombre solo el nombre y en $apellidos los apellidos
        $nombreCompleto  = "Martin del Pozo, Pepe";
        $pieces = explode(",", $nombreCompleto);
        echo "Mis apellidos son " . $apellidos = $pieces[0]; // Martin del Pozo
        echo " y me llamo " . $nombre = $pieces[1]. "</br>" ; // Pepe
        ?>


    </body>
</html>

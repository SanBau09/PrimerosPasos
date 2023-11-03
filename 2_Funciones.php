<?php
//para declarar los tipos extrictamente (no va a considerar un entero como cadena y viceversa)
//DEBE IR SIEMPRE EN LA PRIMERA LINEA DE CODIGO
declare(strict_types=1); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones</title>
</head>
<body>
    <?php
    
    //los parametros de entrada son variables y por tanto llevan $

        //funcion que recoge un nombre y año por parametro y lo muestra
        function nueva($nombre, $year){
            echo "Mi nombre es $nombre y nací en el año $year" . "</br>";
        }

        nueva ("sandra","1991");

        //funcion para sumar dos numeros
        function sumar ($a, $b){
            return $a+$b;
        }
        echo sumar (3,5). "</br>";

        //funcion para sumar dos numeros de forma estricta
        //int|string  ($a puede ser de cualquiera de lso dos tipos)  :int (es para que el echo devuelva un entero)
        function sumasEstricto (int|string $a, int$b):int {
            return $a+$b;
        }
        echo sumar (10,5);

        //funcion que incrementa en uno y lo devuelve
        function incrementar( int $numero):int{
            return ++$numero; 
        }
        $edad = 30;
        $nuevaEdad = incrementar($edad);
        echo "\n Pepe tiene $edad años y se ha incrementado a $nuevaEdad"; //tiene 30, se ha incrementado en 31

        //Parametros con valor  por defecto
        function conectarDB (string $usuario = 'root', string $password= '', string $host='localhost'){
            //Nos conectamos a MySQL con los parametros...
            echo "\n<br>Conectado a $host con usuario $usuario/$password";
        }
        conectarDB();
        conectarDB('pepe');
        conectarDB('pepe', '1234');
        conectarDB('pepe', '1234','192.168.1.11');
    ?>

</body>
</html>
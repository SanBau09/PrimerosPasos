<?php
//2 formas de hacer arrays
$alumnosDAW = ['ali','tom','sam'];

$alumnosDAW = array('ali','tom','sam');

//Modificar elemento del array
$alumnosDAW[0] = 'Jose';

//Añadir elemento al array en la siguiente posicion, se pone sin numero
$alumnosDAW[] = 'Mar';

//Añadir elemento al array en posicion concreta
$alumnosDAW[7] = 'Ana';


//para recorrer el array
foreach($alumnosDAW as $alumno){
    echo "$alumno</br>";
}

//ARRAY ASOCIATIVO (los arrays los nombramos con texto en vez e un indice numerico)
$edadAlum = ['pepe'=>21,'Pat'=>43,'Pon'=>32,];

//muestra 21, 43, 32
foreach($edadAlum as $edad){
    echo "$edad</br>" ;
}
//muestra pepe: 21, Pat:43, Pon:32
foreach($edadAlum as $posicion => $valor){
    echo "$posicion: $valor</br>";
}

//ARRAYS DE DOS DIMENSIONES
$cars =[['Volvo',22,4],['BMW',23,4],['Saab',44,5]]; 

foreach($cars as $coche){
    echo "Marca: " . $coche[0] . " Stock: " .  $coche[1] . " Vendidos: " . $coche[2] . "</br>";
}

//VARIABLES SUPERGLOBALES
foreach($_SERVER as $posicion => $valor){
    echo "$posicion: $valor<br>";
}
echo "Tu ip es " . $_SERVER['REMOTE_ADDR']; //Para imprimir la ip 

?>
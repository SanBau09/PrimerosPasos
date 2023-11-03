<?php
//CRUD -> Create, Read, Update, Delete
$conn = new mysqli('localhost','root','','blog'); //Conecta con mysql

if($conn ->connect_error){
    echo "Error al conectar con MySQL: " . $conn->connect_error;
}

$sql="Insert into usuarios (email,password) values ('pepe@gmail.com','1234')";

if(!$conn ->query($sql)){ //Si hay error en la SQL saltaría este fallo
    die("Error al ejecutar la sql " . $conn->error);
}
echo "Se ha insertado el usuario pepe@gmail.com  con id=" . $conn->insert_id . "<br>";
$idUsuario = $conn->insert_id;

//Actualizar el usuario que acabamos de insertar cuyo email sea pepe@gmail.com y cambiar el email a juan@gmail.com
$sql = "UPDATE usuarios SET email='juan@gmail.com' WHERE id= " . $conn->insert_id;

if(!$conn ->query($sql)){ //Si hay error en la SQL saltaría este fallo
    die("Error al ejecutar la sql " . $conn->error);
}
echo "Se ha actualizado el email a juan@gmail.com con id $idUsuario" ."<br>";
$idUsuario = $conn->insert_id; //guardo el i que acabo de insertar

//Borrar todos los usuarios cuyo email contenga en texto 'juan' e indicar cuantas filas se han borrado
$sql = "DELETE FROM usuarios WHERE email LIKE '%juan%'";

if(!$conn ->query($sql)){ //Si hay error en la SQL saltaría este fallo
    die("Error al ejecutar la sql " . $conn->error);
}
echo "<br> Se han borrado " . $conn->affected_rows . " usuarios que tenian en el email el texto juan";


//Insertar el usuario manolo@gmail.com y password 1234 y crear un mensaje de este usuario
$sql = "Insert into usuarios (email,password,foto) values ('manolo@gmail.com','1234','usuario.jpg')";

if(!$conn ->query($sql)){ //Si hay error en la SQL saltaría este fallo
    die("Error al ejecutar la sql " . $conn->error);
}

$idUsuario = $conn->insert_id;

$sql = "INSERT INTO mensajes(titulo, texto, idUsuario) VALUES ('Cinemania', 'blog de cine', $idUsuario)";

if(!$conn ->query($sql)){ //Si hay error en la SQL saltaría este fallo
    die("Error al ejecutar la sql " . $conn->error);
}
echo "<br> Se ha insertado el usuario manolo@gmail.com con id $idUsuario y un mensaje para este usuario<br>";

//Mostrar datos del usuario con id 22
$sql = "SELECT * FROM usuarios WHERE id =22";
$result = $conn->query($sql);

if(!$result){
    die("Error al ejecutar la sql " . $conn->error);
}
echo "El numero de filas que ha devuelto la sql es " . $result->num_rows . "<br>";

$fila = $result->fetch_assoc();
echo "Email: $fila[email] <br>";
echo "Password: $fila[password] <br>";
echo "Foto: $fila[foto] <br>";


//Mostrar un listado de los usuarios en la base de datos
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if(!$result){
    die("Error al ejecutar la sql " . $conn->error);
}
echo "El numero de filas que ha devuelto la sql es " . $result->num_rows . "<br>";

while($fila = $result->fetch_assoc()){
    echo "Email: $fila[email]  -  Password: $fila[password]  -  Foto: $fila[foto] <br>";
}


//Mostrar datos de todos los usuarios utilizando fetch_all
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if(!$result){
    die("Error al ejecutar la sql " . $conn->error);
}

$rows = $result->fetch_all(MYSQLI_ASSOC);

if (count($rows)>0){
    echo "El número de filas que ha devuelto la SQL es " . count($rows) . "<br>";

    foreach($row as $fila){
        echo "Email: " . $fila['email'] . " Password: " . $fila['password'] . " Foto: " . $fila['foto']  . "<br>";
    }
}else{
    echo "No se encontraron usuarios en la base de datos";
}

?>
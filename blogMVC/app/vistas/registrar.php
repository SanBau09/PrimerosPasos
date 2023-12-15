
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registro de Usuarios</h1>
    
    <form action="index.php?accion=login" method="post" enctype="multipart/form-data">
        <input type="email" name="email"></br>
        <input type="password" name="password" placeholder="password"></br>
        <input type="file" name="foto" accept="image/jpeg, image/png"></br>
        <input type="submit" value="login">

        <a href="index.php">Volver</a>

    </form>
</body>
</html>
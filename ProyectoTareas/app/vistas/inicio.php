<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="web/css/estilos.css">
</head>
<body>
    <h1 class="tituloPagina">Task Manager</h1>

    <form action="index.php?accion=login" method="post">
        <fieldset>
        <legend>Login your account</legend>
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="login">
            <a href="index.php?accion=registrar">registrar</a>
        </fieldset>

    </form>
    
</body>
</html>
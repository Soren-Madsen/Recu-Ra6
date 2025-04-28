 
<!DOCTYPE html>
<html lang="es">
<head>
    <form action="login.php" method="post"></form>
    
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="procesar_registro.php" method="POST">
        <label for="usuario">Nombre de usuario:</label>e usuario<br>
        <input type="text" name="usuario" required><br><br>

        <label for="email">Correo electrónico:</label><br>
        <input type="email" name="email" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label for ="tel"> telefono: </label><br>
        <input type="tel" name="telefono" required><br><br>

        <input type="submit" value="Registrarse">
    </form>

</body>
</html>






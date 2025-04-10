 
<!DOCTYPE html>
<html lang="es">
<head>
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

        <input type="submit" value="Registrarse">
    </form>

    <?php

$usuarios = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "rellena todos los campos",

    $usuario = ($_POST['usuario']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);


    if (empty($usuario) || empty($email) || empty($password)) {
        echo " error! completa todos los campos.";

    } else {
        $usuarios[] = [
            'usuario' => $usuario,
            'email' => $email,
            'password' => $password,
        ];

        echo "su registro se a almacenado correctamente.";
    }
}
?>





</body>
</html>






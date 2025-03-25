<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CineFest Catalunya</title>
</head>

<body>
    <h1>INICIA SESIÓN</h1>
    <h2>Introduce el correo electronico y la contraseña de tu cuenta CFC.</h2>
    <div id="rectangle">
        <form action="" method="POST">
            <!-- DIRECCION DE CORREO ELECTRONICO -->
            <label for="name">
                <h2>Dirección de correo electrónico:</h2>
            </label>
            <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">

            <!-- PASSWORD -->
            <label for="name">
                <h2>Contraseña:</h2>
            </label>
            <input type="password" name="password" pattern="/^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,12}$/g" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" /><br>

            <h3>
                <link href="" value="">¿Has olvidado tu contraseña?
            </h3>
            <!-- LOGIN -->
            <input type="submit" id="login" value="Inicia sesión" />
            <!-- SIGNIN -->
            <input type="submit" id="signin" value="Registrarme" />
        </form>
    </div>
</body>

</html>
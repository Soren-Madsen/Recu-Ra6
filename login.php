
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CineFest Catalunya</title>
</head>



<body>
<?php

?>
    <div id="T_IniciaSession">
        <h1>INICIA SESIÓN</h1>
    </div>
    <div id="T_EmailContraseña">
        <h2>Introduce el correo electrónico y la contraseña de tu cuenta CFC.</h2>
    </div>
    <div id="rectangle">
        <form action="" method="POST">
            <!-- DIRECCION DE CORREO ELECTRONICO -->

            <label for="email">
                <h2>Dirección de correo electrónico:</h2>
            </label>
            <div id="TextBox">
                <input class="inputbox" type="text" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <!-- PASSWORD -->
            <label for="password">
                <h2>Contraseña:</h2>
                <div id="TextBox">

            </label>
                <input class="inputbox" type="password" name="password" pattern="/^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,12}$/g" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" /><br>
            </div>

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
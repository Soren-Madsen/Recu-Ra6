<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./files/style/style.css">
    <link rel="stylesheet" href="./files/style/login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineFest Catalunya // Login</title>
</head>

<body>
    <div id="LoginCentred">
        <div id="T_IniciaSession">
            <h1>INICIA SESIÓN</h1>
        </div>
        <div id="T_EmailContraseña">
            <h2>Introduce el correo electrónico y la contraseña de tu cuenta CFC.</h2>
        </div>
        <div id="rectangle">
            <!-- Formulario para Iniciar Sesión -->
            <form action="../index.php" method="POST">
                <!-- DIRECCION DE CORREO ELECTRONICO -->
                <label for="email">
                    <h2>Dirección de correo electrónico:</h2>
                </label>
                <div id="TextBox">
                    <input class="inputbox" type="text" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <!-- PASSWORD -->
                <label for="pssw">
                    <h2>Contraseña:</h2>
                </label>
                <div id="TextBox">
                    <input class="inputbox" type="password" name="password" pattern="/^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,12}$/g" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" /><br>
                </div>

                <h3>
                    <a href="#">¿Has olvidado tu contraseña?</a>
                </h3>

                <!-- LOGIN -->
                <input type="submit" id="login" value="Inicia sesión" />
            </form>

            <!-- Botón "Registrarme" con enlace directo (alternativa sin JavaScript) -->
            <a href="sign_in.php" id="signin">Registrarme</a>
        </div>
    </div>
</body>

</html>
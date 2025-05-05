<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/files/style/style.css">
    <link rel="stylesheet" href="files/style/login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineFest Catalunya // Login</title>
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="LoginCentred">
        <div id="T_IniciaSession">
            <h1>INICIA SESIÓN</h1>
        </div>
        <div id="T_EmailContraseña">
            <h2>Introduce el correo electrónico y la contraseña de tu cuenta CFC.</h2>
        </div>
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<div class="alert">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']); // Eliminar el mensaje después de mostrarlo
        }
        ?>
        <div id="rectangle">
            <form action="../Controller/UserController.php" method="POST">
                <!-- CORREO ELECTRONICO -->
                <label for="email">
                    <h2>Dirección de correo electrónico:</h2>
                </label>
                <div id="TextBox">
                    <input class="inputbox" type="text" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <!-- PASSWORD -->
                <label for="pssw">
                    <h2>Contraseña:</h2>
                </label>
                <div id="TextBox">
                    <input class="inputbox" type="password" name="password" required pattern="/^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,12}$/g" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" /><br>
                </div>

                <h3>
                    <a href="#">¿Has olvidado tu contraseña?</a>
                </h3>

                <!-- LOGIN -->
                <input type="submit" name="login" id="login" value="Inicia sesión" />
            </form>
            <!-- BOTON REGISTRO -->
            <a href="sign_in.php" id="signin">Registrarme</a>
        </div>
    </div>
</body>

</html>
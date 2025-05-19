<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineFest Catalunya // Perfil</title>
    <link rel="stylesheet" href="./files/style/profile.css">
    <link rel="stylesheet" href="./files/style/navbar.css">
</head>

<body>
    <header>
        <ul id="navbar">
            <h1 id="logo">CFC</h1>
            <input type="checkbox" id="check">
            <label for="check" class="menubtn">
                <i class="fas fa-bars"></i>
            </label>
            <div id="nav-left">
                <a href="#" id="home">Home</a>
                <a href="./events.php" id="events">Eventos</a>
                <a href="./calendar.php" id="calendar">Calendario</a>
                <a href="#" id="news">Noticias</a>
                <a href="#" id="forums">Foros</a>
            </div>
            <input type="checkbox" id="showprofile">
            <label for="showprofile" id="profilebtn" class="navbar-right">
                <i class="fa-solid fa-user" style="font-size: 24px;"></i>
            </label>
            <div id="search-container">
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fa fa-search" style="color:white"></i></button>
            </div>
            <div id="user-info">
                <h1 id="profile">Perfil</h1>
                <?php if (isset($_SESSION["email"])) {
                    echo '
                    <h3 id="usr-email">' . $_SESSION['email'] . '</h3>
                    <img src="./files/img/usr_test.png" id="user-pfp">
                    <h1 id="usr-name">Bienvenido, ' . $_SESSION['username'] . '!</h1>
                    <button class="user-action" id="prof-redirect"><a href="./profile.php">Perfil</a></button>
                    <!--placeholders-->
                    <button class="user-action" id="useraction1"><a href="#">Lorem ipsum</a></button>
                    <button class="user-action" id="useraction2"><a href="#">Lorem ipsum</a></button>
                    <!--placeholders-->
                    <button class="user-action" id="logout"><a href="../Controller/logout.php">Cerrar sesión</a></button>';
                } else {
                    echo '<h1 id="not-logged">No has iniciado sesión</h1>
                    <button class="user-action" id="login"><a href="./login.php">Login</a></button>';
                } ?>
            </div>
        </ul>
    </header>
    <div id="container">
        <?php if (isset($_SESSION["email"])) {
            echo '<div id="profile-container">
            <div id="sidebar">
                <h2>Configuración</h2>
                <ul>
                    <li class="active"><a href="#">Datos Personales</a></li>
                    <li><a href="#">Cambiar Contraseña</a></li>
                    <li><a href="#">Notificaciones</a></li>
                    <li><a href="#">Seguridad</a></li>
                    <li><a href="#">Cerrar sesión</a></li>
                </ul>
            </div>

            <div id="content">
                <div id="welcome-section">
                    <h1>Bienvenido, Usuario</h1>
                </div>

                <div class="profile-section">
                    <h2>Datos Personales</h2>
                    <form id="profile-form">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <select id="nombre" class="inputbox">
                                <option>Selecciona tu nombre</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" id="fecha_nacimiento" class="inputbox">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Número de Teléfono:</label>
                            <input type="tel" id="telefono" class="inputbox">
                        </div>

                        <button type="submit" id="save-btn">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>';
        } else {
            echo 'No has iniciado sesión.';
        } ?>
    </div>
</body>
<script src="https://kit.fontawesome.com/e1205d9581.js" crossorigin="anonymous"></script>

</html>
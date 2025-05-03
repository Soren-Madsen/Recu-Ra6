<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineFest Catalunya // Perfil</title>
    <link rel="stylesheet" href="files/style/profile.css">
</head>

<body>
    <div id="container">
        <header>
            <div id="navbar">
                <div class="nav-left">
                    <h1>CFC</h1>
                    <a href="home.php">Home</a>
                    <a href="eventos.php">Eventos</a>
                    <a href="calendario.php">Calendario</a>
                    <a href="noticias.php">Noticias</a>
                    <a href="fotos.php">Fotos</a>
                </div>
                <div class="nav-right">
                    <div id="user">
                        <span>Bienvenido, Usuario</span>
                    </div>
                </div>
            </div>
        </header>

        <div id="profile-container">
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
        </div>
    </div>
</body>

</html>
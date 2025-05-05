<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./files/style/navbar.css">
    <link rel="stylesheet" href="./files/style/style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Fest Catalunya // Página principal</title>
</head>
<style>
    #calendar {
        background-color: #858585;
    }
    #calendar:hover {
        cursor: default;
    }
</style>
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
                <a href="./View/events.php" id="events">Eventos</a>
                <a href="./View/calendar.php" id="calendar">Calendario</a>
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
                <?php if(isset($_SESSION["email"])) {
                    echo '
                    <h3 id="usr-email">'.$_SESSION['email'].'</h3>
                    <img src="./View/files/img/usr_test.png" id="user-pfp">
                    <h1 id="usr-name">Bienvenido, '.$_SESSION['username'].'!</h1>
                    <button class="user-action" id="prof-redirect"><a href="./View/profile.php">Perfil</a></button>
                    <!--placeholders-->
                    <button class="user-action" id="useraction1"><a href="#">Lorem ipsum</a></button>
                    <button class="user-action" id="useraction2"><a href="#">Lorem ipsum</a></button>
                    <!--placeholders-->
                    <button class="user-action" id="logout"><a href="./Controller/logout.php">Cerrar sesión</a></button>';
                } else {
                    echo '<h1 id="not-logged">No has iniciado sesión</h1>
                    <button class="user-action" id="login"><a href="./View/login.php">Login</a></button>';
                }?>
            </div>
        </ul>
    </header>
    <events>
        <p>Calendario</p>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event id="main-event">
    </events>
    <div id="functions">
        <p>Proximamente</p>
        <p>Pendiente</p>
        <p>En curso</p>
        <p>Cancelado</p>
    </div>
    <div id="sponsors">

    </div>
    <footer>
        <div id="connections"></div>
        <div id="legal-stuff"></div>
    </footer>
</body>
<script src="https://kit.fontawesome.com/e1205d9581.js" crossorigin="anonymous"></script>
</html>
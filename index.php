<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./View/files/style/navbar.css">
    <link rel="stylesheet" href="./View/files/style/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Fest Catalunya // Página principal</title>
</head>
<style>
    #home {
        background-color: #999999;
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
            <a href="./View/profile.php" class="nav-right" id="user"><i class="fa-solid fa-user" style="font-size: 24px;"> </i></a>
            <div id="search-container">
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fa fa-search" style="color:white"></i></button>
            </div>
            <div id="user-info">
                <img src="usr">
                <h1>Bienvenido, user!</h1>
                <button class="user-action"><a href="./View/profile.php">Perfil</a></button>
                <button class="user-action"><a href="#">Lorem ipsum</a></button>
                <button class="user-action"><a href="#">Lorem ipsum</a></button>
            </div>
        </ul>
    </header>
    <events>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event class="event-slideshow"></event>
        <event id="main-event">
    </events>
    <div id="sponsors">

    </div>
    <footer>
        <div id="connections"></div>
        <div id="legal-stuff"></div>
    </footer>
</body>
<script src="https://kit.fontawesome.com/e1205d9581.js" crossorigin="anonymous"></script>
</html>
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
    #home {
        background-color: #999999;
    }
</style>
<body>
    <header>
        <ul id="navbar">
            <h1 id="logo">CFC</h1>
            <a href="#" class="nav-left" id="home">Home</a>
            <a href="#" class="nav-left" id="events">Eventos</a>
            <a href="#" class="nav-left" id="calendar">Calendario</a>
            <a href="#" class="nav-left" id="news">Noticias</a>
            <a href="#" class="nav-left" id="forums">Foros</a>
            <a href="./View/login.php" class="nav-right" id="user"><i class="fa-solid fa-user" style="font-size: 24px;"> </i></a>
            <div id="search-container" class="nav-right">
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fa fa-search" style="color:white"></i></button>
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
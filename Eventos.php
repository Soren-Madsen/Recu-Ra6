<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="View/files/style/Eventos.css">
  <link rel="stylesheet" href="./View/files/style/style.css">
  <link rel="stylesheet" href="./View/files/style/navbar.css">
  <title>Eventos CFC</title>
</head>
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
  <div class="container">
    <aside class="sidebar">
      <h3>Preferencias</h3>
      <input type="text" placeholder="🔍 Buscar">
      <ul>
        <li>Genero</li>
        <li>Ubicación</li>
        <li>Fechas</li>
        <li>Requerimientos</li>
        <li>Tipos</li>
      </ul>
    </aside>

    <main class="content">
      <div class="results-bar">Mostrando ... resultados</div>
      <div class="grid">
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
      </div>
      <div class="load-more">⬇</div>
    </main>
  </div>

</body>
<script src="https://kit.fontawesome.com/e1205d9581.js" crossorigin="anonymous"></script>
</html>

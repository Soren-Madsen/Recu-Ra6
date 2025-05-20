<?php
include "../Controller/UserController.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CineFest Catalunya // Eventos</title>
	<link rel="stylesheet" href="./files/style/navbar.css">
	<link rel="stylesheet" href="./files/style/events.css">

	<script src="https://kit.fontawesome.com/e1205d9581.js" crossorigin="anonymous"></script>
</head>

<body>
	<!-- Navbar completo -->
	<header>
		<ul id="navbar">
			<h1 id="logo">CFC</h1>
			<input type="checkbox" id="check">
			<label for="check" class="menubtn">
				<i class="fas fa-bars"></i>
			</label>
			<div id="nav-left">
				<a href="../index.php" id="home">Home</a>
				<a href="./events.php" id="events" style="background-color:#858585;">Eventos</a>
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
					<button class="user-action" id="useraction1"><a href="#">Mis entradas</a></button>
					<button class="user-action" id="useraction2"><a href="#">Favoritos</a></button>
					<button class="user-action" id="logout"><a href="../Controller/logout.php">Cerrar sesión</a></button>';
				} else {
					echo '<h1 id="not-logged">No has iniciado sesión</h1>
					<button class="user-action" id="login"><a href="./login.php">Login</a></button>';
				} ?>
			</div>
		</ul>
	</header>

	<!-- Contenido de eventos -->
	<div id="events-container">
		<div id="sidebar">
			<h2>Preferencias</h2>
			<form id="filters-form" action="../Controller/EventController.php" method="POST">
				<div class="filter-group">
					<label for="genero">Género</label>
					<select id="genero" name="genre" class="inputbox">
						<option value="all">Todos los géneros</option>
						<option value="drama">Drama</option>
						<option value="comedia">Comedia</option>
					</select>
				</div>

				<div class="filter-group">
					<label for="ubicacion">Ubicación</label>
					<select id="ubicacion" name="location" class="inputbox">
						<option value="all">Todas las ubicaciones</option>
					</select>
				</div>

				<div class="filter-group">
					<label for="fecha">Fechas</label>
					<input type="date" id="fecha" name="date" class="inputbox">
				</div>

				<button type="submit" name="read-filters" id="filter-btn">Aplicar Filtros</button>
			</form>
		</div>

		<div id="content">
			<div id="events-header">
				<h1>EVENTOS</h1>
				<div id="results-count">Mostrando 0 resultados</div>
			</div>

			<div id="events-grid">
				<!-- Aquí iría la carga dinámica con PHP -->
				<div class="event-card">
					<div class="event-poster">
						<!-- <img src="..." alt="Evento"> -->
						<div class="play-trailer">▶</div>
					</div>
					<div class="event-info">
						<h3>Título del Evento</h3>
						<p class="event-genre">Género: Drama</p>
						<p class="event-date">Fecha: 2023-11-15</p>
						<a class="more-info" href="/CFC/View/event.php?id=<?php echo $event['id']; ?>">Más información</a>
					</div>
				</div>
				<div class="event-card">
					<div class="event-poster">
						<!-- <img src="..." alt="Evento"> -->
						<div class="play-trailer">▶</div>
					</div>
					<div class="event-info">
						<h3>Título del Evento</h3>
						<p class="event-genre">Género: Drama</p>
						<p class="event-date">Fecha: 2023-11-15</p>
						<a class="more-info" href="/CFC/View/event.php?id=<?php echo $event['id']; ?>">Más información</a>
					</div>
				</div>
				<div class="event-card">
					<div class="event-poster">
						<!-- <img src="..." alt="Evento"> -->
						<div class="play-trailer">▶</div>
					</div>
					<div class="event-info">
						<h3>Título del Evento</h3>
						<p class="event-genre">Género: Drama</p>
						<p class="event-date">Fecha: 2023-11-15</p>
						<a class="more-info" href="/CFC/View/event.php?id=<?php echo $event['id']; ?>">Más información</a>
					</div>
				</div>
				<div class="event-card">
					<div class="event-poster">
						<!-- <img src="..." alt="Evento"> -->
						<div class="play-trailer">▶</div>
					</div>
					<div class="event-info">
						<h3>Título del Evento</h3>
						<p class="event-genre">Género: Drama</p>
						<p class="event-date">Fecha: 2023-11-15</p>
						<a class="more-info" href="/CFC/View/event.php?id=<?php echo $event['id']; ?>">Más información</a>
					</div>
				</div>
				<div class="event-card">
					<div class="event-poster">
						<!-- <img src="..." alt="Evento"> -->
						<div class="play-trailer">▶</div>
					</div>
					<div class="event-info">
						<h3>Título del Evento</h3>
						<p class="event-genre">Género: Drama</p>
						<p class="event-date">Fecha: 2023-11-15</p>
						<a class="more-info" href="/CFC/View/event.php?id=<?php echo $event['id']; ?>">Más información</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script src="https://kit.fontawesome.com/e1205d9581.js" crossorigin="anonymous"></script>

</html>
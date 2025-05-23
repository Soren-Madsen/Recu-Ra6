<?php
session_start();
include "EventController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST["read"])) {
		$eventController = new EventController();
		echo "<p>Got past MySQL connection</p>";
		echo "<p>read button is clicked.</p>";
		$events = $eventController->readAll();
		// Procesar los resultados según necesites
	}

	if (isset($_POST["delete"])) {
		$eventController = new EventController();
		echo "<p>Delete button is clicked.</p>";
		$eventController->delete();
	}

	if (isset($_POST["create"])) {
		$eventController = new EventController();
		echo "<p>create button is clicked.</p>";
		$eventController->create();
	}

	if (isset($_POST["update"])) {
		$eventController = new EventController();
		echo "<p>update button is clicked.</p>";
		$eventController->update();
	}
}
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
			<form id="filters-form" action="./events.php" method="POST">
				<div class="filter-group">
					<label for="genero">Género</label>
					<select id="genero" name="genre" class="inputbox">
						<option value="">Todos los géneros</option>
						<option value="drama">Drama</option>
						<option value="comedia">Comedia</option>
						<option value="accion">Acción</option>
						<option value="ciencia ficcion">Ciencia Ficción</option>
						<option value="terror">Terror</option>
					</select>
				</div>

				<div class="filter-group">
					<label for="ubicacion">Ubicación</label>
					<select id="ubicacion" name="location" class="inputbox">
						<option value="">Todas las ubicaciones</option>
						<option value="barcelona">Barcelona</option>
						<option value="madrid">Madrid</option>
						<option value="valencia">Valencia</option>
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
				<div id="results-count">Mostrando <?php echo $resultsCount; ?> resultados</div>
			</div>

			<div id="events-grid">
				<?php if (!empty($events)): ?>
					<?php foreach ($events as $event): ?>
						<div class="event-card">
							<div class="event-poster">
								<?php if (!empty($event['poster_image'])): ?>
									<img src="<?php echo htmlspecialchars($event['poster_image']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
								<?php else: ?>
									<div style="background-color: #ddd; height: 300px; display: flex; align-items: center; justify-content: center;">
										Sin imagen
									</div>
								<?php endif; ?>
								<?php if (!empty($event['trailerVideo'])): ?>
									<div class="play-trailer">▶</div>
								<?php endif; ?>
							</div>
							<div class="event-info">
								<h3><?php echo htmlspecialchars($event['title']); ?></h3>
								<p class="event-genre">Género: <?php echo htmlspecialchars($event['genre']); ?></p>
								<p class="event-date">Fecha: <?php echo htmlspecialchars($event['eventDate']); ?></p>
								<?php if (!empty($event['synopsis'])): ?>
									<p class="event-synopsis"><?php echo htmlspecialchars(substr($event['synopsis'], 0, 100)); ?>...</p>
								<?php endif; ?>
								<a class="more-info" href="/CFC/View/event.php?id=<?php echo $event['id']; ?>">Más información</a>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="no-events">
						<p>No se encontraron eventos que coincidan con los filtros seleccionados.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</body>

<script src="https://kit.fontawesome.com/e1205d9581.js" crossorigin="anonymous"></script>

</html>
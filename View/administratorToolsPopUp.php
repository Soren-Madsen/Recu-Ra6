<?php
include "../Controller/UserController.php";
include "../Controller/EventController.php";
$redirect = $_SERVER["REQUEST_URI"];

$events = [];
$resultsCount = 0;
$eventController = new EventController();

$events = $eventController->readAll();

$resultsCount = count($events);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Eventos</title>
</head>

<body>

    <!-- Popup Overlay -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup">
            <button class="close-btn" href="../events.php" onclick="closePopup()">&times; </button>

            <div class="popup-header">
                <h2>🎯 Crear Nuevo Evento</h2>
            </div>

            <div class="message" id="message"></div>

            <!-- FORMULARIO SIMPLE - Se envía directamente al controlador -->
            <form action="../Controller/EventController.php" method="POST">
                <!-- Campo oculto para indicar la acción -->
                <input type="hidden" name="action" value="create_event">

                <div class="form-group">
                    <label for="title">📝 Título del Evento *</label>
                    <input type="text" id="title" name="title" required placeholder="Ej: Titanic">
                </div>

                <div class="form-group">
                    <label for="genre">🎭 Género *</label>
                    <input type="text" id="genre" name="genre" required placeholder="Ej: Drama">
                </div>

                <div class="form-group">
                    <label for="synopsis">📄 Synopsis</label>
                    <textarea id="synopsis" name="synopsis" placeholder="Descripción evento/synopsis..."></textarea>
                </div>

                <div class="form-group">
                    <label for="crew">👥 Crew *</label>
                    <input type="text" id="crew" name="crew" required placeholder="Ej: Soren Madsen">
                </div>

                <div class="form-group">
                    <label for="eventDate">📅 Fecha del Evento *</label>
                    <input type="date" id="eventDate" name="eventDate" required>
                </div>

                <div class="form-group">
                    <label for="trailerVideo">🎬 Video</label>
                    <input type="url" id="trailerVideo" name="trailerVideo" placeholder="https://youtube.com/watch?v=...">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">✨ Crear Evento</button>
                    <a href="../events.php" class="btn btn-secondary" onclick="closePopup(); return false;">❌ Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        // JavaScript mínimo solo para abrir/cerrar popup
        function openPopup() {
            document.getElementById('popupOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById('popupOverlay').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Cerrar popup al hacer clic fuera
        document.getElementById('popupOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup();
            }
        });

        // Cerrar popup con ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
    </script>
</body>

</html>
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
            <button class="close-btn" onclick="closePopup()">&times;</button>

            <div class="popup-header">
                <h2>🎯 Crear Nuevo Evento</h2>
            </div>

            <div class="message" id="message"></div>

            <form id="eventForm" onsubmit="createEvent(event)">
                <div class="form-group">
                    <label for="title">📝 Título del Evento *</label>
                    <input type="text" id="title" name="title" required placeholder="Ej: Conferencia de Tecnología">
                </div>

                <div class="form-group">
                    <label for="description">📄 Descripción</label>
                    <textarea id="description" name="description" placeholder="Describe tu evento..."></textarea>
                </div>

                <div class="form-group">
                    <label for="event_date">📅 Fecha del Evento *</label>
                    <input type="date" id="event_date" name="event_date" required>
                </div>

                <div class="form-group">
                    <label for="event_time">⏰ Hora del Evento</label>
                    <input type="time" id="event_time" name="event_time">
                </div>

                <div class="form-group">
                    <label for="location">📍 Ubicación</label>
                    <input type="text" id="location" name="location" placeholder="Ej: Centro de Convenciones">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">✨ Crear Evento</button>
                    <button type="button" class="btn btn-secondary" onclick="closePopup()">❌ Cancelar</button>
                </div>
            </form>

            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p>Creando evento...</p>
            </div>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById('popupOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById('popupOverlay').classList.remove('active');
            document.body.style.overflow = 'auto';
            resetForm();
        }

        function resetForm() {
            document.getElementById('eventForm').reset();
            document.getElementById('message').style.display = 'none';
            document.getElementById('loading').style.display = 'none';
        }

        function showMessage(text, type) {
            const messageEl = document.getElementById('message');
            messageEl.textContent = text;
            messageEl.className = `message ${type}`;
            messageEl.style.display = 'block';
        }

        async function createEvent(event) {
            event.preventDefault();

            const loadingEl = document.getElementById('loading');
            const formEl = document.getElementById('eventForm');

            // Mostrar loading
            loadingEl.style.display = 'block';
            formEl.style.opacity = '0.6';

            const formData = new FormData(formEl);
            formData.append('action', 'create_event');

            try {
                const response = await fetch('EventController.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    showMessage('🎉 ' + result.message, 'success');
                    setTimeout(() => {
                        closePopup();
                        loadEvents(); // Recargar la lista de eventos
                    }, 2000);
                } else {
                    showMessage('❌ ' + result.message, 'error');
                }
            } catch (error) {
                showMessage('❌ Error de conexión. Inténtalo de nuevo.', 'error');
                console.error('Error:', error);
            } finally {
                // Ocultar loading
                loadingEl.style.display = 'none';
                formEl.style.opacity = '1';
            }
        }

        function loadEvents() {
            // Esta función cargaría los eventos desde el servidor
            // Por ahora mostramos un evento de ejemplo
            const eventsContainer = document.getElementById('events-container');
            eventsContainer.innerHTML = `
                <div class="event-item">
                    <h4>📊 Ejemplo de Evento</h4>
                    <p><strong>Fecha:</strong> 2025-06-15</p>
                    <p><strong>Hora:</strong> 10:00</p>
                    <p><strong>Ubicación:</strong> Auditorio Principal</p>
                    <p>Descripción del evento de ejemplo...</p>
                </div>
            `;
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

        // Cargar eventos al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            loadEvents();
        });
    </script>
</body>

</html>
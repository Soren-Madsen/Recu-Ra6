<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["read"])) {
        $user = new EventController();
        echo "<p>Got past MySQL connection</p>";
        echo "<p>read button is clicked.</p>";
        $user->readAll();
    }

    if (isset($_POST["delete"])) {
        $user = new EventController();
        echo "<p>Delete button is clicked.</p>";
        $user->delete();
    }

    if (isset($_POST["create"])) {
        $user = new EventController();
        echo "<p>create button is clicked.</p>";
        $user->create();
    }

    if (isset($_POST["read_filters"])) {
        $user = new EventController();
        echo "<p>Clicked filter button";
        $user->read_filters();
    }
}

class EventController
{
    private $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "CFC";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function create(): void
    {
        $title = trim($_POST['title']);
        $genre = trim($_POST['genre']);
        $synopsis = trim($_POST['synopsis']);
        $crew = trim($_POST['crew']);
        $eventDate = trim($_POST['eventDate']);
        $trailerVideo = trim($_POST['trailerVideo']);

        if (empty($title) || empty($eventDate)) {
            $_SESSION["error"] = "Datos inválidos.";
            header("Location: ../View/event.php");
            exit;
        }

        $checkStmt = $this->conn->prepare("SELECT title FROM events WHERE title = ?");
        $checkStmt->execute([$title]);

        if ($checkStmt->rowCount() > 0) {
            $_SESSION["error"] = "Ya existe un evento con este nombre.";
            header("Location: ../View/event.php");
            exit;
        }

        $createStmt = $this->conn->prepare("INSERT INTO events (title, genre, synopsis, crew, eventDate, trailerVideo) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$createStmt->execute([$title, $genre, $synopsis, $crew, $eventDate, $trailerVideo])) {
            $_SESSION["error"] = "Hubo un error en crear el evento, acude el equipo administrativo.";
            header("Location: ../View/event.php");
            exit;
        }

        $_SESSION["success"] = "Evento creado satisfactoriamente.";
        header("Location: ../View/event.php");
        exit;
    }

    public function readAll()
    {
        try {
            $readStmt = $this->conn->prepare("SELECT * FROM events ORDER BY eventDate ASC");
            $readStmt->execute();

            $eventdata = $readStmt->fetchAll(PDO::FETCH_ASSOC);
            return $eventdata;
        } catch (PDOException $e) {
            $_SESSION["error"] = "Ha habido un error al recoger los datos del evento: " . $e->getMessage();
            return [];
        }
    }

    public function read_filters()
    {
        $genre = !empty($_POST["genre"]) ? trim($_POST["genre"]) : null;
        $location = !empty($_POST["location"]) ? trim($_POST["location"]) : null;
        $date = !empty($_POST["date"]) ? trim($_POST["date"]) : null;

        try {
            $query = "SELECT * FROM events WHERE 1 = 1";
            $params = [];

            if ($genre) {
                $query .= " AND genre = ?";
                $params[] = $genre;
            }

            if ($location) {
                $query .= " AND location = ?";
                $params[] = $location;
            }

            if ($date) {
                $query .= " AND DATE(eventDate) = ?";
                $params[] = $date;
            }

            $query .= " ORDER BY eventDate ASC";

            $readFiltersStmt = $this->conn->prepare($query);
            $readFiltersStmt->execute($params);

            $events = $readFiltersStmt->fetchAll(PDO::FETCH_ASSOC);
            return $events;
        } catch (PDOException $e) {
            $_SESSION["error"] = "Error al buscar eventos con los filtros: " . $e->getMessage();
            return [];
        }
    }

    public function getEventById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM events WHERE id = ?");
            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION["error"] = "Error al obtener el evento: " . $e->getMessage();
            return null;
        }
    }

    public function update(): void
    {
        $id = trim($_POST['id']);
        $newTitle = trim($_POST['title']);
        $genre = trim($_POST['genre']);
        $synopsis = trim($_POST['synopsis']);
        $crew = trim($_POST['crew']);
        $eventDate = trim($_POST['eventDate']);
        $trailerVideo = trim($_POST['trailerVideo']);

        if (empty($id) || empty($newTitle) || empty($eventDate)) {
            $_SESSION["error"] = "Datos inválidos.";
            header("Location: ../View/event.php");
            exit;
        }

        try {
            $updateStmt = $this->conn->prepare("UPDATE events SET title = ?, genre = ?, synopsis = ?, crew = ?, eventDate = ?, trailerVideo = ? WHERE id = ?");

            if ($updateStmt->execute([$newTitle, $genre, $synopsis, $crew, $eventDate, $trailerVideo, $id])) {
                $_SESSION["success"] = "Evento actualizado correctamente.";
            } else {
                $_SESSION["error"] = "Error al actualizar el evento.";
            }
        } catch (PDOException $e) {
            $_SESSION["error"] = "Error al actualizar el evento: " . $e->getMessage();
        }

        header("Location: ../View/event.php");
        exit;
    }

    public function delete(): void
    {
        $title = $_POST["title"];

        if (empty($title)) {
            $_SESSION["error"] = "Datos inválidos.";
            header("Location: ../View/event.php");
            exit;
        }

        $checkStmt = $this->conn->prepare("SELECT * FROM events WHERE title = ?");
        $checkStmt->execute([$title]);

        if ($checkStmt->rowCount() === 0) {
            $_SESSION["error"] = "El evento no existe.";
            header("Location: ../View/event.php");
            exit;
        }

        $deleteStmt = $this->conn->prepare("DELETE FROM events WHERE title = ?");
        if ($deleteStmt->execute([$title])) {
            $_SESSION["success"] = "El evento se ha eliminado correctamente.";
        } else {
            $_SESSION["error"] = "Error al eliminar el evento, contacte con un administrador.";
        }

        header("Location: ../View/event.php");
        exit;
    }
}

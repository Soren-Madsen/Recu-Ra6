<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["read"])) {
        $user = new EventController();
        echo "<p>Got past MySQL connection</p>";
        echo "<p>read button is clicked.</p>";
        $user->read();
    }

    if (isset($_POST["delete"])) {
        $user = new EventController();
        echo "<p>Logout button is clicked.</p>";
        $user->delete();
    }

    if (isset($_POST["create"])) {
        $user = new EventController();
        echo "<p>create button is clicked.</p>";
        $user->create();
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


            $dbName = $this->conn->query("SELECT DATABASE()")->fetchColumn();
            echo "Connected to DB: " . $dbName;
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
            header("../View/event.php");
        }

        $checkStmt = $this->conn->prepare("SELECT title FROM events WHERE title = ?");
        $checkStmt->execute([$title]);

        if ($checkStmt->rowCount() > 0) {
            $_SESSION["error"] = "Ya existe un evento con este nombre.";
            header("../View/event.php");
        }

        $createStmt = $this->conn->prepare("INSERT INTO events VALUES (?, ?, ?, ?, ?, ?)");
        if ($createStmt->execute([$title, $genre, $synopsis, $crew, $eventDate, $trailerVideo])) {
            $_SESSION["error"] = "Hubo un error en crear el evento, acude el equipo administrativo.";
            header("../View/event.php");
        }

        $_SESSION["success"] = "Evento creado satisfactoriamente.";
        header("../View/event.php");
        exit;
    }

    public function read(): void
    {
        $readStmt = $this->conn->prepare("SELECT * FROM events");
        if (!$readStmt->execute()) {
            $_SESSION["error"] = "Ha habido un error al recoger los datos del evento.";
            header("../View/event.php");
            exit;
        }

        $eventdata = $readStmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION["fetch-successful"] = true;
        $_SESSION["event-title"] = $eventdata[0]["title"];
        $_SESSION["genre"] = $eventdata[0]["genre"];
        $_SESSION["synopsis"] = $eventdata[0]["synopsis"];
        $_SESSION["crew"] = $eventdata[0]["crew"];
        $_SESSION["eventDate"] = $eventdata[0]["eventDate"];
        $_SESSION["trailerVideo"] = $eventdata[0]["trailerVideo"];
    }

    // Needs another method to comply with the event page filters
    public function read_filters(): void {}

    public function update(): void
    {

        $newTitle = trim($_POST['title']);
        $genre = trim($_POST['genre']);
        $synopsis = trim($_POST['synopsis']);
        $crew = trim($_POST['crew']);
        $eventDate = trim($_POST['eventDate']);
        $trailerVideo = trim($_POST['trailerVideo']);

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
            $_SESSION["success"] = " El Evento eliminado correctamente.";
        } else {
            $_SESSION["error"] = "Error al eliminar el evento. Intente de nuevo mas tarde.";
        }

        header("Location: ../View/event.php");
        exit;
    }
}

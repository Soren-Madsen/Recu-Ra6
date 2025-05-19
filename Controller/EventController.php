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

        if ($checkStmt -> rowCount() > 0) {
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
        /** STEP BY STEP READ 
         * READ EVENT TO APPLICATION 
         * RECUPERAR LO QUE EL EVENTO ENVIO $POST
         * CONECTAR MYSQL
         * EVALUAR EL RESULTADO
         * REDIRIGIR A LA PESTAÑA EVENTO
         */
    }

    public function delete(): void {}
}

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
        /** STEP BY STEP CREATE 
         * CREATE EVENT TO APPLICATION 
         * RECUPERAR LO QUE EL EVENT ENVIO $POST
         * CONECTAR MYSQL
         * EVALUAR EL RESULTADO
         * REDIRIGIR A LA PESTAÑA EVENTO
         */

        if (empty($_POST['event'])) {
            $_SESSION["error"] = "No hay eventos registrados.";
            header("Location: ../View/events.php");
            exit;
        }

        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $synopsis = $_POST['synopsis'];
        $crew = $_POST['crew'];
        $eventDate = $_POST['eventDate'];
        $trailerVideo = $_POST['trailerVideo'];

        $stmt = $this->conn->prepare("SELECT id, title, genre, synopsis, crew, eventDate, trailerVideo FROM users WHERE email = ?");

        if (!$stmt->execute([$email])) {
            $_SESSION["error"] = "Error en la consulta";
            header("Location: ../View/login.php");
            exit;
        }

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($user[0]["email"])) {
            $_SESSION["error"] = "Usuario no encontrado";
            header("Location: ../View/login.php");
            exit;
        }

        if (!password_verify($inputPassword, $user[0]["password"])) {
            $_SESSION["error"] = "Contraseña incorrecta";
            header("Location: ../View/login.php");
            exit;
        }

        $_SESSION['logged'] = true;
        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['username'] = $user[0]['name'];
        $_SESSION['email'] = $user[0]['email'];

        header("Location: ../index.php");
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

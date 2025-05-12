<?php
session_start();

// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // check button
    if (isset($_POST["login"])) {
        $user = new EventController();
        echo "<p>Got past MySQL connection</p>";
        echo "<p>Login button is clicked.</p>";
        $user->login();
    }

    if (isset($_POST["logout"])) {
        $user = new EventController();
        echo "<p>Logout button is clicked.</p>";
        $user->logout();
    }

    if (isset($_POST["register"])) {
        $user = new EventController();
        echo "<p>Register button is clicked.</p>";
        $user->register();
    }
}

class EventController
{

    /** STEP BY STEP LOGIN 
     * LOGIN USER TO APPLICATION 
     * RECUPERAR LO QUE EL USUARIO ENVIO $POST
     * CONECTAR MYSQL
     * EVALUAR EL RESULTADO
     * REDIRIGIR A USERPROFILE
     */

    private $conn;
    public function __construct()
    {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "CFC";

        $this->conn = new mysqli($servername, $username, $password, $database);

        $dbCheck = $this->conn->query("SELECT DATABASE()");
        $dbRow = $dbCheck->fetch_row();
        echo ("Connected to DB: " . $dbRow[0]);

        if ($this->conn->connect_error) {
            die("Conexión failed: " . $this->conn->connect_error);
        }
    }

    public function login(): void {}

    public function logout(): void {}
    public function register(): void {}
}

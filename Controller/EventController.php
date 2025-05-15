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
    public function create(): void {}
}

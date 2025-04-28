<?php


//
//login user to application -->
//recuperar lo que el usuario envio POST -->
// conectar MySQL -->
// select users -->
// evaluar el resultado -->
// redirigir a donde toca userprofile -->
// }
session_start();

// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new UserController();

    // check button
    if (isset($_POST["login"])) {
        echo "<p>Login button is clicked.</p>";
        $user->login();
    }

    if (isset($_POST["logout"])) {
        echo "<p>Logout button is clicked.</p>";
        $user->logout();
    }

    if (isset($_POST["register"])) {
        echo "<p>Register button is clicked.</p>";
        $user->register();
    }
}

class UserController
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


        // 2. Connectar MySQL
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root"; // Cambiar según la configuración de la BD
        $password = ""; // Cambiar si hay contraseña
        $database = "CFC";

        // Crear connection
        $this->conn = new mysqli($servername, $username, $password, $database);

        // Verificar conexión
        if ($this->conn->connect_error) {
            die("Conexión failed: " . $this->conn->connect_error);
        }
        echo "Completed succesfully.";
    }

    /**
     * login user to application
     */
    public function login(): void
    {
        // Login logic
        $email = $_POST['email'];
        $pass = $_POST['pssw'];

        // 3.SQL Statement (SELECTS)
        $stmt = $this->conn->prepare(query: "SELECT name, email FROM users WHERE name=? AND");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // 4.evaluar el resultado  
        if ($row = $result->fetch_assoc()) {
            // Autenticación exitosa  
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            $this->conn->close();
        } else {
            $_SESSION["logged"] = false;
            $_SESSION["error"] = "Invalid username or password.";

            $this->conn->close();

            // redirect to login
            header(header: "Location: .../view/login.php");
        }
    }

    /**
     * logout user from application
     */
    public function logout(): void
    {

        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;


        // Logout logic
    }

    public function register(): void {}
} 
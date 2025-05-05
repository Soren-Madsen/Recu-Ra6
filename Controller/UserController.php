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
echo __LINE__;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo __LINE__;
    $user = new UserController();
    
    // check button
    if (isset($_POST["login"])) {
        echo __LINE__;
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
        echo __LINE__;
        // get data from form request
        $email = $_POST['email'];
        $pass = $_POST['password'];
        echo __LINE__;
        
        // 3.SQL Statement (SELECTS)
        $stmt = $this->conn->prepare("SELECT email, password FROM users WHERE email=? AND password=?");
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        
        echo __LINE__;
        // 4.evaluar el resultado  
        if ($row = $result->fetch_assoc()) {
            // Autenticación exitosa  
            echo __LINE__;
            $_SESSION['logged'] = true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            
            $this->conn->close();
            // redirect to index
            echo __LINE__;
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION["logged"] = false;
            $_SESSION["error"] =  "Invalid username or password.";

            $this->conn->close();

            // redirect to login
            header(header: "Location: ../view/login.php");
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

    public function register(): void {
        $usuarios = [];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "rellena todos los campos",
        
            $usuario = ($_POST['usuario']);
            $email = ($_POST['email']);
            $password = ($_POST['password']);
            $tel = ($_POST['tel']);
        
        
            if (empty($usuario) || empty($email) || empty($password) || empty($tel)) {
                echo " error! completa todos los campos.";
            } else {
                $usuarios[] = [
                    'usuario' => $usuario,
                    'email' => $email,
                    'password' => $password,
                    'tel' => $tel,
                ];
        
                echo "su registro se a almacenado correctamente.";
            }

    }
}

}

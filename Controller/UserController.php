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
    echo "<p>Got past POST check</p>";
    // check button
    if (isset($_POST["login"])) {
        $user = new UserController();
        echo "<p>Got past MySQL connection</p>";
        echo "<p>Login button is clicked.</p>";
        $user->login();
    }

    if (isset($_POST["logout"])) {
        $user = new UserController();
        echo "<p>Logout button is clicked.</p>";
        $user->logout();
    }

    if (isset($_POST["register"])) {
        $user = new UserController();
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
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "CFC";

        $this->conn = new mysqli($servername, $username, $password, $database);

        $dbCheck = $this->conn->query("SELECT DATABASE()");
        $dbRow = $dbCheck->fetch_row();
        echo("Connected to DB: " . $dbRow[0]);

        if ($this->conn->connect_error) {
            die("Conexión failed: " . $this->conn->connect_error);
        }
    }

    public function login(): void
    {
        echo __LINE__;
        // get data from form request
        $email = $_POST['email'];
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        echo $pass;
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
            echo "Reached failure.";
            $_SESSION["logged"] = false;
            $error =  "Invalid username or password.";

            $this->conn->close();

            // redirect to login
            header(header: "Location: ../View/login.php");
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
        header("Location: ../index.php");
        exit;


        // Logout logic
    }

    public function register(): void {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = ($_POST['usuario']);
            $email = ($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $date = date("Y-m-d");

            if (empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo("Invalid input.");
                exit("Invalid input.");
            } else {
                $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, creation_date) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $username, $email, $password, $date);

                if (!$stmt->execute()) {
                    echo("DB insert failed: " . $stmt->error);
                    exit("Failed to insert data.");
                }

                echo("Insert ID: " . $this->conn->insert_id);
                $result = $this->conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
                $row = $result->fetch_assoc();
                echo("Last inserted user: " . json_encode($row));

                $stmt->close();
                echo("Inserted values successfully.");
                
                header("Location: ../View/login.php");
                exit;
            }
        }
    }
}

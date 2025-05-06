<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new UserController();

    if (isset($_POST["login"])) {
        $user->login();
    }

    if (isset($_POST["logout"])) {
        $user->logout();
    }

    if (isset($_POST["register"])) {
        $user->register();
    }
}

class UserController
{
    private $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "CFC";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to DB: " . $database . "<br>";
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    public function login(): void
    {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION["error"] = "Por favor complete todos los campos";
            header("Location: ../View/login.php");
            exit;
        }

        $email = $_POST['email'];
        $inputPassword = $_POST['password'];

        $stmt = $this->conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $_SESSION["error"] = "Usuario no encontrado";
            header("Location: ../View/login.php");
            exit;
        }

        if (!password_verify($inputPassword, $user['password'])) {
            $_SESSION["error"] = "Contraseña incorrecta";
            header("Location: ../View/login.php");
            exit;
        }

        $_SESSION['logged'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        header("Location: ../View/userprofile.php");
        exit;
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        header("Location: ../View/login.php");
        exit;
    }

    public function register(): void
    {
        $username = trim($_POST['usuario']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $date = date("Y-m-d");

        if (empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "Datos inválidos.";
            header("Location: ../View/sign_in.php");
            exit;
        }

        // Verificar si el correo ya existe
        $checkStmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->execute([$email]);

        if ($checkStmt->rowCount() > 0) {
            $_SESSION["error"] = "La dirección de correo ya está registrada.";
            header("Location: ../View/sign_in.php");
            exit;
        }

        // Insertar nuevo usuario
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, creation_date) VALUES (?, ?, ?, ?)");
        if (!$stmt->execute([$username, $email, $password, $date])) {
            $_SESSION["error"] = "Error al crear la cuenta.";
            header("Location: ../View/sign_in.php");
            exit;
        }

        $_SESSION["success"] = "Registro exitoso. Inicia sesión.";
        header("Location: ../View/login.php");
        exit;
    }
}

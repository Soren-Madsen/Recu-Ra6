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
    if (isset($_POST["delete"])) {
        $user->delete();
    }
}

class UserController
{
    private $conn;

    private function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../View/login.php");
        exit;
    }

    public function __construct()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "CFC";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to DB: " . $database . "<br>";
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage() . "\nContacte un administrador.");
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

    public function delete(): void
    {
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
            $_SESSION["error"] = "Debes iniciar sesión para realizar esta acción";
            header("Location: ../View/login.php");
            exit;
        }

        $user_id = $_SESSION['id'];

        if (!$user_id || $user_id <= 0) {
            $_SESSION["error"] = "ID de usuario inválido";
            header("Location: ../View/userprofile.php");
            exit;
        }
        try {
            $this->conn->beginTransaction();

            // Eliminar el usuario
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$user_id]);

            // Verificar si se eliminó algún registro
            if ($stmt->rowCount() === 0) {
                $this->conn->rollBack();
                $_SESSION["error"] = "Usuario no encontrado";
                header("Location: ../View/userprofile.php");
                exit;
            }

            $this->conn->commit();

            // Si el usuario se eliminó a sí mismo, cerrar sesión
            if ($user_id == $_SESSION['id']) {
                $this->logout();
            } else {
                $_SESSION["success"] = "Usuario eliminado correctamente";
                header("Location: ../View/admin/users.php");
                exit;
            }
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error al eliminar usuario: " . $e->getMessage());
            $_SESSION["error"] = "Error al eliminar el usuario";
            header("Location: ../View/userprofile.php");
            exit;
        }
    }

    public function updateProfile(): void
    {
        $newName = trim($_POST["name"]);
        $newEmail = trim($_POST["email"]);

        if (empty($newName) || !filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "Datos invalidos.";
            header("../View/profile.php");
            exit;
        }

        $updateStmt = $this->conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        if (!$updateStmt->execute([$newName, $newEmail, $_SESSION["id"]])) {
            $_SESSION["error"] = "Ha habido un error al actualizar el usuario, contacte un administrador.";
            header("Location: ../View/profile.php");
            exit;
        }

        $readStmt = $this->conn->prepare("SELECT name, email FROM users WHERE id = ?");

        if (!$readStmt->execute([$_SESSION["id"]])) {
            $_SESSION["error"] = "Error en la consulta";
            header("Location: ../View/login.php");
            exit;
        }

        $user = $readStmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            $_SESSION["error"] = "Error inesperado (tu cuenta existe?)";
            header("Location: ../View/profile.php");
            exit;
        }

        // Update session variables to accomodate new values.
        $_SESSION["username"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["success"] = "Perfil actualizado correctamente!";
        header("Location: ../View/profile.php");
        exit;
    }

    public function updatePasswd(): void
    {
        $newPasswd = trim(password_hash($_POST["passwd"], PASSWORD_DEFAULT)) ?? '';
        $oldPasswd = trim($_POST["oldpassword"]) ?? '';

        if (empty($oldPasswordInput) || empty($newPasswordInput)) {
            $_SESSION["error"] = "Datos invalidos.";
            header("Location: ../View/password_update.php");
            exit;
        }

        $readStmt = $this->conn->prepare("SELECT password FROM users WHERE id = ?");
        if (!$readStmt->execute([$_SESSION["id"]])) {
            $_SESSION["error"] = "Error inesperado, no se ha podido leer la base de datos.";
            header("Location: ../View/password_update.php");
            exit;
        }

        $oldPasswdDB = $readStmt->fetch(PDO::FETCH_ASSOC);
        if (!$oldPasswdDB) {
            $_SESSION["error"] = "Error inesperado (el usuario existe?)";
            header("Location: ../View/password_update.php");
            exit;
        }

        if (!password_verify($oldPasswd, $oldPasswdDB["password"])) {
            $_SESSION["error"] = "La contraseñas antiguas no coinciden.";
            header("Location: ../View/password_update.php");
            exit;
        }

        $updateStmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        if (!$updateStmt->execute([$newPasswd, $_SESSION["id"]])) {
            $_SESSION["error"] = "Ha habido un error al guardar la nueva contraseña, contacte un administrador.";
            header("Location: ../View/password_update.php");
            exit;
        }

        $_SESSION["success"] = "Contraseña actualizada exitosamente.";
        header("Location: ../View/password_update.php");
        exit;
    }
}

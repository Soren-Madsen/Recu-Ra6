<?php
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
    private $conn;
    public function __construct()
    {
        // Constructor logic
    }

    /**
     * login user to application
     */
    public function login(): void
    {
        // Login logic


    }
    
    /**
     * logout user from application
     */
    public function logout(): void
    {
        // Logout logic
    }

    public function register(): void
    {
    
        // Register logic
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name1 = htmlspecialchars($_POST['name1']);
    $date1 = htmlspecialchars($_POST['date1']);
    $url1 = htmlspecialchars($_POST['url1']);
    $marcas = htmlspecialchars($_POST['marcas1']);
    $germans1 = htmlspecialchars($_POST['germans1']);
    $genero = htmlspecialchars($_POST['genero']);
    $home = htmlspecialchars($_POST['home']);
    $dona = htmlspecialchars($_POST['dona']);
    $menjar = htmlspecialchars($_POST['menjar']);
    $xocolata = htmlspecialchars($_POST['xocolata']);
    $pa = htmlspecialchars($_POST['pa']);
    $bledes = htmlspecialchars($_POST['bledes']);
    $llenties = htmlspecialchars($_POST['llenties']);

}
echo  "Nom: " . $name1 . "<br>";
echo  "Naixement: " . $date1 . "<br>";
echo  "Blog: " . $url1 . "<br>";
echo  "Germans: ". $germans1 . "<br>";
echo  "Marca: " . $marcas . "<br>";

if (isset($genero) && $genero=="Home") {
    echo "Home: Marcado" . "<br>";
}
if (isset($genero) && $genero=="Dona") {
    echo "Dona: Marcado" . "<br>";
}   
if (isset($_REQUEST)=="xocolata") {
    echo "Xocolata: Marcado" . "<br>";
}
if (isset($_REQUEST)=="pa") {
    echo "Pa: Marcado" . "<br>";
}
if (isset($_REQUEST)=="bledes") {
    echo "Bledes: Marcado" . "<br>";
}
if (isset($_REQUEST)=="llenties") {
    echo "Llenties: Marcado" . "<br>";
}
    }
}
?>
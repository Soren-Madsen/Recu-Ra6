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
        // Logout logic
    }
}

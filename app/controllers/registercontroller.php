<?php
session_start();
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';

class RegisterController extends Controller {
    
    private $loginService;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
    }

    public function index() {
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Hash the password before storing it
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Call the insertUser method to add the user to the database
            $this->loginService->insertUser($username, $hashedPassword);

            // Redirect to the login page or home page after successful registration
            header('Location: /');
            exit();
        }

        include '../views/register.php';
    }
}
?>

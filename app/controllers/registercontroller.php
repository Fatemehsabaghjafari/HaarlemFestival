<?php
session_start();
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';

class RegisterController extends Controller
{

    private $loginService;
    private $errorMsg;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
    }

    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0) {
                $this->errorMsg = "The captcha code isn't correct. Please try again";
                include '../views/register.php';
                return;
            }

            $username = filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);


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

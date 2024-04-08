<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';

class LoginController extends Controller {
    
    private $loginService;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
    }

    public function index() {
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Fetch all users from the database
            $users = $this->loginService->getAllUsers();

            // Check if the entered username exists and the password is correct
            foreach ($users as $user) {
                if ($username === $user->username && password_verify($password, $user->password)) {
                    // Authentication successful
                    $_SESSION['user'] = $user;
                    if ($user->roleId == 1) {
                        header('Location: /admin'); // Redirect to the admin page
                    } else {
                        header('Location: /'); // Redirect to the main page
                    }
                    exit();
                }
            }
            // Authentication failed
            $error = 'Invalid username or password';
        }

        if(isset($_SESSION['user'])) {
            include '../views/logout.php';
        } else {
            // If not logged in, show the login form
            include '../views/login.php';
        }

    }

    public static function getUserId() {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user']->id;
        } else {
            return null; // User not logged in
        }
    }
}


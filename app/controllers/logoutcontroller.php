<?php
session_start();
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';

class LogoutController extends Controller {
    
    private $loginService;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
    }

    public function index() {
        
        $this->logout();
       
        include '../views/logout.php';
    }
    public function logout() {
        // Unset all session variables
        $_SESSION = array();
    
        // Destroy the session
        session_destroy();
    
        // Redirect to the login page after logout
        header('Location: /');
        exit();
    }
    
    
}

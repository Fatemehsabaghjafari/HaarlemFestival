<?php
require_once __DIR__ . '/../models/user.php';
session_start();
require_once __DIR__ . '/../services/adminservice.php';
require_once __DIR__ . '/../services/loginservice.php';
require_once __DIR__ . '/controller.php';

class AdminController extends Controller
{
    private $adminService;
    private $loginService;

    public function __construct()
    {
        $this->adminService = new \App\Services\AdminService();
        $this->loginService = new \App\Services\LoginService();
    }

    private function checkAuthorization()
    {
        if (!isset($_SESSION['user'])) {
            echo 'Only authorized admins are allowed!';
            echo 'please login first! <a href="/login">Login</a> ';
            return false;
        }
        // Assuming roleId is a property of the User object
        if ($_SESSION['user']->roleId != 1) {
            echo 'You do not have permission to access this page.';
            return false;
        }
        return true;
    }

    public function index()
    {
        if ($this->checkAuthorization()) {
            $danceVenues = $this->adminService->getAllVenues();
            include '../views/adminView.php';
        }
    }

    public function danceAdmin()
    {
        if ($this->checkAuthorization()) {
            $danceArtists = $this->adminService->getAllArtists();
            include '../views/danceArtistsAdmin.php';
        }
    }

    public function danceVenueAdmin()
    {
        if ($this->checkAuthorization()) {
            $danceVenues = $this->adminService->getAllVenues();
            include '../views/danceVenueAdmin.php';
        }
    }

    public function userAdmin()
    {
        if ($this->checkAuthorization()) {
            $users = $this->loginService->getAllUsers();
            include '../views/userAdmin.php';
        }
    }
}

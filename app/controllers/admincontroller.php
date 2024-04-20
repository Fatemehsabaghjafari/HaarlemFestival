<?php
require_once __DIR__ . '/../models/user.php';
session_start();

require_once __DIR__ . '/../services/loginservice.php';
require_once __DIR__ . '/../services/danceEventsAdminservice.php';
require_once __DIR__ . '/../services/danceArtistAdminservice.php';
require_once __DIR__ . '/../services/danceVenueAdminservice.php';
require_once __DIR__ . '/controller.php';

class AdminController extends Controller
{
    private $danceVenueAdminService;
    private $danceArtistAdminService;
    private $danceEventsAdminService;
    private $loginService;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
        $this->danceEventsAdminService = new \App\Services\DanceEventsAdminService();
        $this->danceVenueAdminService = new \App\Services\DanceVenueAdminService();
        $this->danceArtistAdminService = new \App\Services\DanceArtistAdminService();
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
            include '../views/adminView.php';
        }
    }

    public function danceAdmin()
    {
        if ($this->checkAuthorization()) {
            $danceArtists = $this->danceArtistAdminService->getAllArtists();
            include '../views/danceArtistsAdmin.php';
        }
    }

    public function danceVenueAdmin()
    {
        if ($this->checkAuthorization()) {
            $danceVenues = $this->danceVenueAdminService->getAllVenues();
            include '../views/danceVenueAdmin.php';
        }
    }

    public function danceEventAdmin()
    {
        if ($this->checkAuthorization()) {
            $venueNames = $this->danceEventsAdminService->getVenueNames();
            $danceEvents = $this->danceEventsAdminService->getAllEvents();
            include '../views/danceEventAdmin.php';
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

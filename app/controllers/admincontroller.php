<?php

require_once __DIR__ . '/../services/adminservice.php';
require_once __DIR__ . '/controller.php';

class AdminController extends Controller
{
    private $adminService;

    public function __construct()
    {
        $this->adminService = new \App\Services\AdminService();
    }

    public function index()
    {
        $danceTickets = $this->adminService->getAllEvents();
        $danceArtists = $this->adminService->getAllArtists();
        $danceVenues = $this->adminService->getAllVenues();

        include '../views/adminView.php';
    }
}

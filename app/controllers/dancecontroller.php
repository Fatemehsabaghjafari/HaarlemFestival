<?php

require_once __DIR__ . '/../services/danceservice.php';
require_once __DIR__ . '/controller.php';

class DanceController extends Controller
{
    private $danceService;

    public function __construct()
    {
        $this->danceService = new \App\Services\DanceService();

    }

    public function index()
    {      
        include '../views/dance.php';
    }
}

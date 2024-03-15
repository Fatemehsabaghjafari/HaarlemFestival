<?php

require_once __DIR__ . '/../services/ratatouilleservice.php';
require_once __DIR__ . '/controller.php';

class RatatouilleController extends Controller
{
    private $ratatouilleService;


    public function __construct()
    {
        $this->ratatouilleService = new \App\Services\RatatouilleService();

    }

    public function index()
    {      
        include '../views/ratatouille.php';
    }
}

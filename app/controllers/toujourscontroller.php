<?php

require_once __DIR__ . '/../services/toujoursservice.php';
require_once __DIR__ . '/controller.php';

class ToujoursController extends Controller
{
    private $toujoursService;


    public function __construct()
    {
        $this->toujoursService = new \App\Services\ToujoursService();

    }

    public function index()
    {      
        include '../views/toujours.php';
    }
}

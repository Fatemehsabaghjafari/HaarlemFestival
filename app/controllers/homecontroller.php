<?php

require_once __DIR__ . '/../services/homeservice.php';
require_once __DIR__ . '/controller.php';

class HomeController extends Controller
{
    private $homeService;


    public function __construct()
    {
        $this->flowerService = new \App\Services\HomeService();

    }

    public function index()
    {
      
        include '../views/home/index.php';
    }
}
